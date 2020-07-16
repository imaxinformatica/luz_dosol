<?php

namespace App\Http\Controllers\Api;

use App\ParticularShip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{
    public function checkZipCode(Request $request)
    {
        return ParticularShip::where('cep_initial','<', $request->zip_code)
        ->where('cep_final', '>', $request->zip_code)
        ->count();
    }
}
