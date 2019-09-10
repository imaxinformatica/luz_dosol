<?php

namespace App\Services;

use App\ActiveUser;
use App\User;

class ServiceCheckout
{

    public function activeUser(User $user)
    {
        $date = date('Y-m-d');
        ActiveUser::create([
            'user_id' => $user->id,
            'date_active' => $date
        ]);
        $user->status = 1;
        $user->save();
    }
}
