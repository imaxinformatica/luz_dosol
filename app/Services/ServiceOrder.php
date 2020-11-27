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
        $orderItem = new Orderitem;
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

    public static function createComission($order_id, User $user)
    {
        for ($i = 1; $i < 11; $i++) {

            if ($i > 1 && $user->user_id != null) {
                $user = User::find($user->user_id);
            }
            if ($user->user_id == null) {
                continue;
            }
            $comission = Commission::first();

            $commissionPercentage = "commission_" . $i;
            $totalOrder = OrderCommission::where('user_id', $user->user_id)
                ->where('order_id', $order_id)
                ->count();

            if ($totalOrder > 0) {
                continue;
            }
            OrderCommission::create([
                'order_id' => $order_id,
                'user_id' => $user->user_id,
                'commission_percentage' => $comission->$commissionPercentage,
            ]);
        }
    }

    public static function createSpecialBonus($user_id)
    {
        Bonus::create([
            'user_id' => $user_id,
            'price' => 34,
            'level_bonus' => 6,
        ]);
    }

    public static function createBonus()
    {
        
    }

    public function generateReport($date)
    {
        $users = User::get();
        $array = [];
        foreach ($users as $key => $user) {
            $data['código'] = $user->id;
            $data['nome'] = $user->name;
            $data['valor'] = ($user->getTotalBonus($date[0], $date[1]));
            if ($data['valor'] == 0) {
                continue;
            }
            if (!$user->databank) {
                return dd($user);
            }
            $data['código banco'] = $user->databank->bank_code;
            $data['agência'] = $user->databank->agency;
            $data['conta'] = $user->databank->account;
            $data['díg. conta'] = $user->databank->account_type;
            $data['cpf titular'] = $user->databank->cpf_holder;
            $data['nome titular'] = $user->databank->name_holder;
            $data['graduação'] = $user->graduation_name;
            $array[$key] = $data;
        }
        return $array;
    }

    public function transfeeraReport($date)
    {
        $users = User::get();
        $array = [];
        foreach ($users as $key => $user) {
            $valor = $user->getTotalBonus($date[0], $date[1]);
            if ($valor == 0) {
                continue;
            }
            $data['nome'] = $user->name;
            $data['cpf titular'] = $user->databank->cpf_holder;
            $data['e-mail'] = $user->email;
            $data['código banco'] = str_pad($user->databank->bank_code, 3, 0, STR_PAD_LEFT);
            $data['agência'] = str_pad($user->databank->agency, 4, 0, STR_PAD_LEFT);
            $data['conta'] = $user->databank->account;
            $data['díg. conta'] = $user->databank->account_type;
            $data['tipo de conta'] = $user->databank->type_account;
            $data['valor'] = convertMoneyUSAtoBrazil($valor);
            $array[$key] = $data;
        }
        return $array;
    }
    

}
