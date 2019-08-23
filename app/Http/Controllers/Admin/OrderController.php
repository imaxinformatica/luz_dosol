<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.pages.order.index')
        ->with('orders', $orders);
    }

    public function show(Order $order)
    {
        return view('admin.pages.order.show')
        ->with('order', $order);
    }
}
