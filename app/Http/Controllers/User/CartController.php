<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\{Cart, Product};
use App\Services\CartService;
use Auth;

class CartController extends Controller
{
    public function include(CartRequest $request)
    {
        $user = Auth::guard('user')->user();
        $data = $request->except('_token');
        
        $data['user_id'] = $user->id;
        $product = Product::find($request->product_id);
        if(!$product){
            return redirect()->back()
            ->with('error', 'Tivemos problemas em localizar este produto no sistema');
        }
        $data['price'] = $product->price;
        
        $response = CartService::include($user,$data);
        
        return redirect()->back()->with($response['status'], $response['msg']);
    }

    public function delete(Cart $cart)
    {
        try {
            $cart->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Item removido do carrinho.');
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
        $productCart = $user->cart()->where('product_id', $product->id)->first();
        if($productCart){
            $productCart->pivot->update([
                'qty' => $request->value
            ]);
        }  
        session()->flash('success', 'Atualizado com sucesso');
        return response()->json();
    }
}
