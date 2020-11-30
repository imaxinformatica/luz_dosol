<?php

namespace App\Services;

use App\User;
use App\Bonus;
use App\Commission;
use App\OrderCommission;

class OrderService
{
    public function setSpecialBonus($user_id)
    {
        Bonus::create([
            'user_id' => $user_id,
            'price' => 34,
            'level_bonus' => 6,
        ]);
    }   
    public function setCommission($order_id, User $user)
    {
        for ($i = 1; $i < 11; $i++) {

            if ($i > 1 && $user->user_id != null) {
                $user = User::find($user->user_id);
            }
            if ($user->user_id == null) {
                continue;
            }
            $commission = Commission::first();

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
                'commission_percentage' => $commission->$commissionPercentage,
            ]);
        }
    } 
}