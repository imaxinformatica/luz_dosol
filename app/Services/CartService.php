<?php

namespace App\Services;

use App\Cart;

class CartService
{
    public static function store(array $data)
    {
        try {
            Cart::updateOrCreate(
                ['product_id' => $data['product_id'], 'user_id' => $data['user_id']],
                $data
            );
            return ['status' => 'success', 'msg' => 'Item adicionado com sucesso'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'msg' => 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage()];
        }
    }

    public static function delete(Cart $cart)
    {
        try {
            $cart->delete();
            return ['status' => 'success', 'msg' => 'Item removido com sucesso'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'msg' => 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage()];
        }
    }

    public static function update($user, array $data)
    {
        $productCart = $user->cart()
            ->where('product_id', $data['product_id'])->first();
        if (!$productCart) {
            return ['status' => 'error', 'msg' => 'Não conseguimos localizar este item no sistema'];
        }
        try {
            $productCart->pivot->update([
                'qty' => $data['value'],
            ]);
            return ['status' => 'success', 'msg' => 'Item atualizado com sucesso'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'msg' => 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage()];
        }
    }
}
