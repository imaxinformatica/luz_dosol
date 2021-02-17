<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('user')->user();
        $user->children = \listChildren($user, 10);
        return view('user.pages.user.index')
            ->with('user', $user);
    }
}
