<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Databank extends Model
{
    protected $fillable = [
        'user_id',
        'bank_code',
        'agency',
        'account',
        'account_type',
        'cpf_holder',
        'name_holder',
        'type_account'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
