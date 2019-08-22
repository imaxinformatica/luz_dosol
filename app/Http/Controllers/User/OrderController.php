<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ServiceOrder;
use App\{Order,Cart,Orderitem};
use Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $sv = new ServiceOrder;

        $user = Auth::guard('user')->user();
        if(count($user->cart) == 0){
            return redirect()->back()->with('warning', 'O pedido precisa ter ao mínimo um item no carrinho');
        }
        $i = 1;

        if($user->total() > 200 && $user->status == 0){
            $user->status = 1;
            $user->save();
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
