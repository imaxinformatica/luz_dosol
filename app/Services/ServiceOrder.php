<?php

namespace App\Services;

use App\Bonus;
use App\Commission;
use App\ExtraBonus;
use App\Order;
use App\OrderCommission;
use App\Orderitem;
use App\Product;
use App\User;

class ServiceOrder
{

    public function createOrderItem(int $user_id, int $order_id, Product $product, $itemCart): void
    {
        $orderItem = new Orderitem();
        $orderItem->user_id = $user_id;
        $orderItem->order_id = $order_id;
        $orderItem->product_id = $product->id;
        $orderItem->qty = $itemCart->qty;
        $orderItem->price = $product->price;
        $orderItem->subtotal = $product->price * $itemCart->qty;
        $orderItem->save();
    }

    public function generateOrder(array $data, array $arrayPagSeguro, int $user_id)
    {
        try {
            $order = new Order();
            $order->user_id = $user_id;
            $order->shipping = $arrayPagSeguro['shipping']['cost'];
            $order->payment_link = $data['payment_method'] == 'boleto' ? $arrayPagSeguro['paymentLink'] : null;
            $order->subtotal = convertMoneyBraziltoUSA($data['price']);
            $order->payment_method = $data['payment_method'];
            $order->status = $arrayPagSeguro['status'];
            $order->code = $arrayPagSeguro['code'];
            $order->delivery_time = $data['delivery_time'];
            $order->total = ($arrayPagSeguro['grossAmount']);
            $order->save();
            return $order;
        } catch (\Exception $e) {
            $msg = ['error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage()];
            return null;
        }
    }

}
