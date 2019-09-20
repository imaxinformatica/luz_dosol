<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class GraduatedController extends Controller
{
    public function index(Request $request)
    {
        $users = new User();
        if($request->has('id')){
            if(request('id') != ''){
                $users = $users->where('id', request('id'));
            }
        }
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
        $users = $users->get();

        $filtered = $users->filter(function ($user) {
            return $user->getTotalPlatinumGraduation() > 0;
        });
        $users = $filtered;
        return view('admin.pages.graduated.index')
        ->with('users', $users);
    }
}
