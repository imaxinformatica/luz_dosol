<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ServiceOrder;
use App\{ActiveUser, Order};
use App\Services\ServiceCheckout;
use Auth;

class OrderController extends Controller
{
    public function checkout(Request $request, ServiceCheckout $sv)
    {
        $sv = new ServiceOrder;

        $user = Auth::guard('user')->user();
        if (count($user->cart) == 0) {
            return redirect()->back()->with('warning', 'O pedido precisa ter ao mínimo um item no carrinho');
        }
        if ($user->total() >= 200 && $user->status == 0) {
            $sv->activeUser($user);
        }


        $order = new Order;
        $order->user_id = $user->id;
        $order->total = $user->total();
        $order->save();

        $sv->createComission($order->id, $user);



        foreach ($user->cart as $items) {
            $sv->createOrderItem($user->id, $order->id, $items, $items->pivot);
            $items->pivot->delete();
        }
        return redirect()->route('user.order.index')->with('success', 'Pedido finalizado');
    }

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
