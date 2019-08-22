<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCommission extends Model
{
    protected $fillable = [
        'order_id',
        'user_id' ,
        'commission_percentage',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

}
