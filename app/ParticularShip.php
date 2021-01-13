<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticularShip extends Model
{
    protected $fillable =[
        'city',
        'cep_initial',
        'cep_final',
        'price',
    ];
}
