<?php

namespace App\Services;

use App\{Bonus, Product, OrderItem, OrderCommission, User, Commission, Order};

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
            $order->subtotal = $arrayPagSeguro['grossAmount'];
            $order->payment_method = $data['payment_method'];
            $order->status = $arrayPagSeguro['status'];
            $order->code = $arrayPagSeguro['code'];
            $order->delivery_time = $data['delivery_time'];
            $order->total = ($arrayPagSeguro['grossAmount'] + $arrayPagSeguro['shipping']['cost']);
            $order->save();
            return $order;
        } catch (\Exception $e) {
            $msg = ['error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage()];
            return null;
        }
    }

    public function createComission($order_id, User $user)
    {
        for ($i = 1; $i < 11; $i++) {


            if ($i > 1 && $user->user_id != null) {
                $user = User::find($user->user_id);
            }
            if ($user->user_id == null) {
                continue;
            }
            $comission = Commission::first();

            $commissionPercetage = "commission_" . $i;

            OrderCommission::create([
                'order_id' => $order_id,
                'user_id'  => $user->user_id,
                'commission_percentage' => $comission->$commissionPercetage,
            ]);
        }
    }

    public function createBonus()
    {
        $users = User::where('status', 1)->get();
        $month = date("m");
        $year = date("Y");

        foreach ($users as $user) {
            // level 1
            $networkUser = $user->users()->where('status', 1)->count();

            $bonus = $user->bonus()->whereMonth('updated_at', $month)->whereYear('updated_at', $year)->get();
            if ($networkUser >= 3) {
                if (count($bonus->where('level_bonus', 1)) == 0) {

                    Bonus::create([
                        'user_id' => $user->id,
                        'price' => 10,
                        'level_bonus' => 1
                    ]);
                }
            }
            // level 2
            $usersLevel1 = $user->users()->pluck('id')->toArray();
            $usersLevel2 = User::whereIn('user_id', $usersLevel1)->where('status', 1)->get();

            if (count($usersLevel2) >= 6) {
                if (count($bonus->where('level_bonus', 2)) == 0) {

                    Bonus::create([
                        'user_id' => $user->id,
                        'price' => 20,
                        'level_bonus' => 2
                    ]);
                }
            }
            // level 3
            $usersLevel2 = User::whereIn('user_id', $usersLevel1)->pluck('id')->toArray();
            $usersLevel3 = User::whereIn('user_id', $usersLevel2)->where('status', 1)->get();

            if (count($usersLevel3) >= 14) {
                if (count($bonus->where('level_bonus', 3)) == 0) {

                    Bonus::create([
                        'user_id' => $user->id,
                        'price' => 40,
                        'level_bonus' => 3
                    ]);
                }
            }
            // level 4
            $usersLevel3 = User::whereIn('user_id', $usersLevel2)->pluck('id')->toArray();
            $usersLevel4 = User::whereIn('user_id', $usersLevel3)->where('status', 1)->get();

            if (count($usersLevel4) >= 40) {
                if (count($bonus->where('level_bonus', 4)) == 0) {

                    Bonus::create([
                        'user_id' => $user->id,
                        'price' => 120,
                        'level_bonus' => 4
                    ]);
                }
            }
            // level 5
            $usersLevel4 = User::whereIn('user_id', $usersLevel3)->pluck('id')->toArray();
            $usersLevel5 = User::whereIn('user_id', $usersLevel4)->where('status', 1)->get();
            if (count($usersLevel5) >= 122) {
                if (count($bonus->where('level_bonus', 5)) == 0) {

                    Bonus::create([
                        'user_id' => $user->id,
                        'price' => 360,
                        'level_bonus' => 5
                    ]);
                }
            }
        }
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
            $data['graduação'] = $user->getNameGraduation();
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
            $data['código banco'] = str_pad($user->databank->bank_code, 3, 0, STR_PAD_LEFT );
            $data['agência'] = str_pad($user->databank->agency, 4, 0, STR_PAD_LEFT );
            $data['conta'] = $user->databank->account;
            $data['díg. conta'] = $user->databank->account_type;
            $data['tipo de conta'] = 'VERIFICAR';
            $data['valor'] = convertMoneyUSAtoBrazil($valor);
            $array[$key] = $data;
        }
        return $array;
    }
}
