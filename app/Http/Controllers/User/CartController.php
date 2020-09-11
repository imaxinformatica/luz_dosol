<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Product;use App\Services\CartService;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(CartRequest $request)
    {
        $user = Auth::guard('user')->user();
        $data = $request->except('_token');

        $data['user_id'] = $user->id;
        $product = Product::find($request->product_id);
        if (!$product) {
            return redirect()->back()
                ->with('error', 'Tivemos problemas em localizar este produto no sistema');
        }
        $data['price'] = $product->price;
        $response = CartService::store($data);

        return redirect()->back()
            ->with($response['status'], $response['msg']);
    }

    public function delete(Cart $cart)
    {
        $response = CartService::delete($cart);
        return redirect()->back()
            ->with($response['status'], $response['msg']);

    }

    public function cart()
    {
        $user = Auth::guard('user')->user();

        $itemsCart = $user->cart;
        $total = 0;
        foreach ($itemsCart as $item) {
            $item->subtotal = $item->price * $item->pivot->qty;
            $total += $item->subtotal;
        }
        return view('user.pages.checkout.index')
            ->with('user', $user)
            ->with('total', $total)
            ->with('itemsCart', $itemsCart);
    }

    public function update(Request $request, Product $product)
    {
        $user = Auth::guard('user')->user();
        $data = $request->all();
        $data['product_id'] = $product->id;
        $response = CartService::update($user, $data);
        session()->flash($response['status'], $response['msg']);
        return response()->json();
    }
}
