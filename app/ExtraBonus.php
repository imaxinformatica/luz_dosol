<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraBonus extends Model
{
    protected $table = 'extra_bonus';
    protected $fillable = [
        'user_id',
        'price',
        'level_bonus',        
    ];
}
