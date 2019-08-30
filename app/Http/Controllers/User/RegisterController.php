<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{State, Bank};

class RegisterController extends Controller
{
    public function sessionRegister(Request $request)
    {
        session(['user_id' => $request->id]);

        return redirect()->route('register.finish');
    }

    public function register()
    {
        $states = State::all();
        $banks = Bank::orderBy('bank_code', 'asc')->get();
        return view('user.auth.finish')
            ->with('banks', $banks)
            ->with('states', $states);
    }
}
