<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $fillable =[
        'user_id',
        'price',
        'level_bonus'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
