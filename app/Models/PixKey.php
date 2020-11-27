<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PixKey extends Model
{
    protected $fillable = [
        'key',
        'user_id',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
