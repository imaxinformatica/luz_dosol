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
        $users = new User;

        $users = $users->where('user_id', $user->id);
        if($request->has('name')){
            if(request('name') != ''){
                $users = $users->where('name', 'like', request('name') . '%');
            }
        }
        if($request->has('email')){
            if(request('email') != ''){
                $users = $users->where('email', 'like', request('email') . '%');
            }
        }
        $users = $users->orderBy('name', 'asc')->paginate(20);
        return view('user.pages.user.index')->with('users', $users);
    }

}
