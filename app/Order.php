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
            case 0:
                $status = "Pendente";

                break;
            case 1:
                $status = "Aguardando Pagamento";

                break;
            case 2:
                $status = "Em Análise";

                break;
            case 3:
                $status = "Pago";

                break;
            case 4:
                $status = "Disponível";

                break;
            case 5:
                $status = "Em Disputa";

                break;
            case 6:
                $status = "Devolvida";

                break;
            case 6:
                $status = "Cancelada";

                break;
            default:
                $status = "";
                break;
        }
        return $status;
    }
}
