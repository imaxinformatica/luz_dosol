<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user')->user();
        $products = Product::where('status', 1)->get();
        $itemscart = $user->cart;
        return view('user.pages.product.index')
            ->with('itemscart', $itemscart)
            ->with('products', $products);
    }
}
