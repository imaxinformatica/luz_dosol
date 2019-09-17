<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'reference',
        'description',
        'price',
        'weight',
        'height',
        'width',
        'length',
        'file',
        'category_id',
        'status',
    ];
    

    public function status()
    {
        $status = $this->status == 0 ? 'Desativado' : 'Ativado';
        return $status;
    }

    public function orderitems()
    {
        return $this->hasMany('App\Orderitem', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
