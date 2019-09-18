<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'shipping',
        'payment_link',
        'subtotal',
        'payment_method',
        'delivery_time',
        'status',
        'code',
        'code',
        'total',
    ];

    public function orderitems()
    {
        return $this->hasMany('App\Orderitem', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
