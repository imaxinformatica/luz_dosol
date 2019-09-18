<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveUser extends Model
{
    protected $fillable = [
        'user_id', 
        'date_active'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
