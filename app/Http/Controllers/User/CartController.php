<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\{Cart, Product};
use Auth;

class CartController extends Controller
{
    public function include(CartRequest $request)
    {
        $user = Auth::guard('user')->user();
        $data = $request->except('_token');

        $data['user_id'] = $user->id;
        
        try {
            $product = Product::find($request->product_id);
            $data['price'] = $product->price;

            Cart::updateOrCreate(
                ['product_id' => $data['product_id'], 'user_id' => $data['user_id']],
                $data
            );
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->back()->with('success', 'Item adicionado ao carrinho.');
    }

    public function delete(Cart $cart)
    {
        try {
            $cart->delete();
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->back()->with('success', 'Item removido do carrinho.');
    }

    public function checkout()
    {
        $user = Auth::guard('user')->user();

        $itemsCart = $user->cart;
        $total = 0;
        foreach ($itemsCart as $item) {
            $item->subtotal = $item->price * $item->pivot->qty;
            $total += $item->subtotal;
        }
        return view('user.pages.checkout.index')
        ->with('total', $total)
        ->with('itemsCart', $itemsCart);
    }
}
