<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ServiceOrder;
use App\{Order, User};
use App\Http\Requests\CheckoutRequest;
use App\Services\ServiceCheckout;
use App\Services\ServiceShipping;
use Auth;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function getSession()
    {
        $data['email'] = config('services.pagseguro.pagseguro_email');
        $data['token'] = config('services.pagseguro.pagseguro_token');

        $curl = curl_init();


        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'));
        curl_setopt($curl, CURLOPT_URL, "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        curl_close($curl);
        $resp = simplexml_load_string($resp);
        return $resp->id;
    }

    public function checkout(CheckoutRequest $request, ServiceCheckout $svCheckout)
    {
        $svOrder = new ServiceOrder;

        $user = Auth::guard('user')->user();

        $date = date('m-Y');
        list($month, $year) = explode('-', $date);

        $totalOrders = $user->orders()->whereMonth('updated_at', $month)->whereYear('updated_at', $year)->count();

        if ($totalOrders == 0 && $user->total() < 200) {
            return redirect()->back()->with('warning', 'O primeiro pedido do mês precisa ser no mínimo de R$200,00');
        }
        if (count($user->cart) == 0) {
            return redirect()->back()->with('warning', 'O pedido precisa ter ao mínimo um item no carrinho');
        }
        $queryParams['email'] = config('services.pagseguro.pagseguro_email');
        $queryParams['token'] = config('services.pagseguro.pagseguro_token');
        $queryParams = http_build_query($queryParams);
        $data = $request->all();
        $data['user'] = $user;
        $dataPayment = $request->payment_method == 'boleto' ? ['paymentMethod' => 'boleto'] : $svCheckout->dataCard($data);
        $payload = array_merge(
            $svCheckout->dataMain($data),
            $dataPayment,
            $svCheckout->dataItems($user),
            $svCheckout->getShipping($request->all())
        );
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'));
        curl_setopt($curl, CURLOPT_URL, "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?{$queryParams}");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($payload));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($resp);

        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        if (isset($array['error'])) {
            $error = isset($array['error'][0]) ? $array['error'][0]['message'] : $array['error']['message'];
            $msg = "Ops, tivemos um problema no nosso servidor, entre em contato com um de nossos adminsitradores. Erro: {$error}";
            return redirect()->back()->with('error', $msg);
        }

        $order = $svOrder->generateOrder($request->all(), $array, $user->id);
        if ($order) {

            foreach ($user->cart as $items) {
                $svOrder->createOrderItem($user->id, $order->id, $items, $items->pivot);
                $items->pivot->delete();
            }
            return redirect()->route('user.order.index')->with('success', 'Pedido finalizado');
        }
        return redirect()->route('user.order.index')
            ->with('error', 'Tivemos um problema ao processar o seu pedido, por favor entre em contato com um de nossos administradores');
    }

    public function getShipping(Request $request, ServiceShipping $svShipping)
    {
        $user = Auth::guard('user')->user();
        $error = $svShipping->getError();
        if ($error) {
            return 'null';
        }
        $data = $svShipping->generateArrayShipping($request->zip_code, $request->shipping_type);

        $data = http_build_query($data);

        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx";
        try {
            // cURL
            $curl = curl_init($url . '?' .  $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curl);
            curl_close($curl);
            //!end cUrl 

            $xml = simplexml_load_string($result);
            $json = json_encode($xml);
            $json = json_decode($json, TRUE);

            $newTotal = $user->total() + convertMoneyBraziltoUSA($json['cServico']['Valor']);

            $array = [
                'shipping_price' => $json['cServico']['Valor'],
                'delivery_time' => $json['cServico']['PrazoEntrega'],
                'new_total' => convertMoneyUSAtoBrazil($newTotal)
            ];
            return json_encode($array);
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function callback(Request $request)
    {
        $svCheckout = new ServiceCheckout; 
        $notification = $request->notificationCode;
        $data['email'] = config('services.pagseguro.pagseguro_email');
        $data['token'] = config('services.pagseguro.pagseguro_token');
        $data = http_build_query($data);
        $url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/{$notification}?{$data}";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $xml = curl_exec($ch);
        curl_close($ch);

        $xml = simplexml_load_string($xml);

        $order = Order::where('code', $xml->code)->first();
        if ($order) {
            $user = User::find($order->user_id);
            $svOrder = new ServiceOrder;
            if($user->orders()->count() == 0 && $user->user_id !== null){
                $svOrder->createSpecialBonus($user->user_id);
            }
            $svOrder->createComission($order->id, $user);

            if ($user->total() >= 200 && $user->status == 0) {
                $svCheckout->activeUser($user);
            }
            $order->update(['status' => $xml->status]);
        }
    }

    public function index()
    {
        $user = Auth::guard('user')->user();
        $orders = Order::where('user_id', $user->id)->get();
        return view('user.pages.order.index')
            ->with('orders', $orders);
    }

    public function show(Order $order)
    {
        return view('user.pages.order.show')
            ->with('order', $order);
    }
}
