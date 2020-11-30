<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'month',
        'year',
        'user_id',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
