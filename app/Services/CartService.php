<?php

namespace App\Services;

use App\Cart;

class CartService
{
    public static function include(array $data)
    {
        
        try {
            Cart::updateOrCreate(
                ['product_id' => $data['product_id'], 'user_id' => $data['user_id']],
                $data
            );
            return ['status' => 'success', 'msg'=> 'Item adicionado com sucesso'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'msg'=> 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage()];
        }
    }
}