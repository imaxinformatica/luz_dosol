<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\User;
use App\Product;
use App\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 1)->get();
        $recentOrders = new Order;
        $recentOrders = $recentOrders->take(7)->orderBy('id', 'Desc')->get();
        return view('admin.pages.dashboard.index')
        ->with('recentOrders', $recentOrders)
        ->with('users', User::all())
        ->with('products', Product::all())
        ->with('orders', Order::all())
        ->with('banners', $banners);
    }
}
