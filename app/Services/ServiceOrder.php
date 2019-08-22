<?php

namespace App\Services;

use App\{Product, OrderItem, OrderCommission, User, Commission};

class ServiceOrder
{
    public function createOrderItem(int $user_id, int $order_id, Product $product, $itemCart): void
    {
        $orderItem = new Orderitem;
        $orderItem->user_id = $user_id;
        $orderItem->order_id = $order_id;
        $orderItem->product_id = $product->id;
        $orderItem->qty = $itemCart->qty;
        $orderItem->price = $product->price;
        $orderItem->subtotal = $product->price * $itemCart->qty;
        $orderItem->save();
    }
    
    public function createComission($order_id, User $user)
    {
        for($i=1; $i < 11; $i++){


            if($i > 1 && $user->user_id != null){
                $user = User::find($user->user_id);
            }
            if($user->user_id == null){
                continue;
            }
            $comission = Commission::first();

            $commissionPercetage = "commission_".$i;

            OrderCommission::create([
                'order_id' => $order_id,
                'user_id'  => $user->user_id,
                'commission_percentage' => $comission->$commissionPercetage,
            ]);
        }

            
    }
}