<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('user')->user();

        $users = User::where('user_id', $user->id)->orderBy('name', 'asc')->get();

        return view('user.pages.user.index')->with('users', $users);
    }
}
