<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'slug',
        'name',
        'content',
    ];
}
