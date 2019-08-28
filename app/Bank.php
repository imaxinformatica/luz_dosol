<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'bank_code',
        'bank_name',
    ];

    protected $primaryKey = 'bank_code';
}
