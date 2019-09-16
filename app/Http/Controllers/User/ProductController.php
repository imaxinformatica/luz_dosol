<?php

namespace App\Http\Controllers\User;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('user')->user();

        $products = new Product;
        if ($request->has('name')) {
            if (request('name') != '') {
                $products = $products->where('name', 'like', '%' . request('name') . '%');
            }
        }
        if ($request->has('reference')) {
            if (request('reference') != '') {
                $products = $products->where('reference', 'like', '%' . request('reference') . '%');
            }
        }
        if ($request->has('category_id')) {
            if (request('category_id') != '') {
                $products = $products->where('category_id', request('category_id'));
            }
        }
        $products = $products->where('status', 1);
        $products = $products->orderBy('reference', 'asc')->paginate(20);

        $itemscart = $user->cart;

        return view('user.pages.product.index')
            ->with('itemscart', $itemscart)
            ->with('categories', Category::get())
            ->with('products', $products);
    }
}
