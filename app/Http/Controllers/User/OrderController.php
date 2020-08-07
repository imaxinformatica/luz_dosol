<?php

namespace App\Http\Controllers\User;

use Auth;
use App\User;
use App\Cycle;
use App\Order;
use App\Services\ServiceOrder;
use App\Services\ServiceCheckout;
use App\Services\ServiceShipping;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
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
        $array = json_decode($json, true);
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

    public function getShipping(Request $request)
    {
        $user = Auth::guard('user')->user();

        if($request->shipping_type == "particular") {
            $shippingPrice = ServiceShipping::getPriceParticular($request->zip_code);
            $newTotal = $user->total() + $shippingPrice;
            $cycle = Cycle::first();
            $array = [
                'delivery_time' => $cycle->particular_time,
                'shipping_price' => convertMoneyUSAtoBrazil($shippingPrice),
                'new_total' => convertMoneyUSAtoBrazil($newTotal),
            ];
            return json_encode($array);
        }
        $repeatBox = ServiceShipping::repeatCalculatePrice();
        // $error = ServiceShipping::getError($repeatBox);
        // if ($error) {
        //     return 'null';
        // }
        $dataSmall;
        $dataBig;
        $shipping = [
            'small' => 0,
            'big' => 0,
        ];
        $deliveryTime = [
            'small' => 0,
            'big' => 0,
        ];

        $smallBox = [
            'length' => 35,
            'height' => 32,
            'width' => 33,
            'volume' => 36960,
            'repeatBox' => $repeatBox,
        ];
        $bigBox = [
            'length' => 50,
            'height' => 32,
            'width' => 33,
            'volume' => 52800,
            'repeatBox' => $repeatBox ,
        ];
        
        if($repeatBox['small'] != 0){
            $dataSmall = ServiceShipping::generateArrayShipping(
                $request->zip_code,
                $request->shipping_type,
                $repeatBox['small'],
                $smallBox
            );
            $ship['small'] = ServiceShipping::getShippingPrice($dataSmall);
            $shipping['small'] = convertMoneyBraziltoUSA($ship['small']['cServico']['Valor']);
            $deliveryTime['small'] = $ship['small']['cServico']['PrazoEntrega'];
        }
        if($repeatBox['big'] != 0){
            $dataBig = ServiceShipping::generateArrayShipping(
                $request->zip_code,
                $request->shipping_type, 
                $repeatBox['big'],
                $bigBox
            );
            $ship['big'] = ServiceShipping::getShippingPrice($dataBig);
            $shipping['big'] = convertMoneyBraziltoUSA($ship['big']['cServico']['Valor']);
            $deliveryTime['big'] = $ship['big']['cServico']['PrazoEntrega'];
        }
        $deliveryTimeReal = $deliveryTime['big'] > $deliveryTime['small'] ? $deliveryTime['big'] : $deliveryTime['small'];
        try {
            $shippingPrice = ($shipping['small'] * $repeatBox['small']) + ($shipping['big'] * $repeatBox['big']);
            $newTotal = $user->total() + $shippingPrice;

            $array = [
                'delivery_time' => $deliveryTimeReal,
                'shipping_price' => convertMoneyUSAtoBrazil($shippingPrice),
                'new_total' => convertMoneyUSAtoBrazil($newTotal),
            ];
            return json_encode($array);
        } catch (\Exception $e) {
            return 'error'. $e->getMessage();
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

            $date = date('m-Y');
            list($month, $year) = explode('-', $date);
            
            $firstOrder = $user->orders()->count();
            if ($firstOrder == 0 && $user->user_id !== null) {
                ServiceOrder::createSpecialBonus($user->user_id);
            }
            ServiceOrder::createComission($order->id, $user);

            if ($user->getTotalMonth() >= 200 && $user->status == 0) {
                ServiceCheckout::activeUser($user);
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
