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

    public function getStatus()
    {
        switch ($this->status) {
            case 1:
                $status = "Agendada";

                break;
            case 2:
                $status = "Processando";

                break;
            case 3:
                $status = "Não Processada";

                break;
            case 4:
                $status = "Suspensa";

                break;
            case 5:
                $status = "Paga";

                break;
            case 6:
                $status = "Não Paga";

                break;
            default:
                $status = "";
                break;
        }
        return $status;
    }
}
