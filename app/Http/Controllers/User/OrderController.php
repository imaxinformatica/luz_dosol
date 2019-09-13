<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ServiceOrder;
use App\{Order};
use App\Http\Requests\CheckoutRequest;
use App\Services\ServiceCheckout;
use Auth;

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
            $msg = "Ops, tivemos um problema no nosso servidor, entre em contato com um de nossos adminsitradores. Erro: {$array['error']['code']}";
            // return dd($array['error']['code']. " - " .$array['error']['message']);
            return redirect()->back()->with('error', $msg);
        }

        if ($user->total() >= 200 && $user->status == 0) {
            $svCheckout->activeUser($user);
        }
        $order = $svOrder->generateOrder($request->all(),$array, $user->id);
        
        $svOrder->createComission($order->id, $user);

        foreach ($user->cart as $items) {
            $svOrder->createOrderItem($user->id, $order->id, $items, $items->pivot);
            $items->pivot->delete();
        }
        return redirect()->route('user.order.index')->with('success', 'Pedido finalizado');
    }

    public function getDataTransaction($transactionCode)
    {
        $data['email'] = config('services.pagseguro.pagseguro_email');
        $data['token'] = config('services.pagseguro.pagseguro_token');
        $data = http_build_query($data);

        $url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/{$transactionCode}?{$data}";
        $headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $xml = curl_exec($ch);
        curl_close($ch);
        echo $xml;
        $xml = simplexml_load_string($xml);
        $reference = $xml->reference;
        $status = $xml->status;
        if ($reference && $status) { }
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
