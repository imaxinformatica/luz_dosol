<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'zip_code',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'user_id',
        'state',
    ];

    public function state()
    {
        return $this->belongsTo('App\State', 'state', 'initials');
    }
}
