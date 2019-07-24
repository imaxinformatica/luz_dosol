<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = new User;

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
        return view('admin.pages.user.index')->with('users', $users);
    }

    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(UserRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        User::create($request->all());
        return redirect()->back()->with('success', 'Usuário adicionado.');
    }

    public function edit(User $user)
    {
        return view('admin.pages.user.edit')->with('user', $user);
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->except('_token', 'user_id'));
        return redirect()->back()->with('success', 'Usuário editado.');
    }

    public function status(User $user)
    {
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return redirect()->back()->with('success', 'Status alterado.');

    }
}
