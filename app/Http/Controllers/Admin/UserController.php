<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\ServiceUser;
use App\{User, State, Address, Databank};

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
        $states = State::all();
        return view('admin.pages.user.create')
        ->with('states', $states);
    }

    public function store(UserRequest $request, ServiceUser $service)
    {
        $dataUser = $service->generateDatauser($request->all());
        $dataAdress = $service->generateDataAddress($request->all());
        try {
            $user = User::create($dataUser);
            $user->address()->create($dataAdress);
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->back()->with('success', 'Usuário adicionado.');
    }

    public function edit(User $user)
    {
        return view('admin.pages.user.edit')->with('user', $user);
    }

    public function update(User $user, UserRequest $request)
    {
        try{
            $user->update($request->except('_token', 'user_id'));
        } catch (\Exception $e) {
            return redirect()->route('admin.user.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->back()->with('success', 'Usuário editado.');
    }

    public function status(User $user)
    {
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return redirect()->back()->with('success', 'Status alterado.');

    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::find($request->user_id);

        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Senha alterada com sucesso.');

    }

    public function attach(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'user_id' => 'required'
        ]);

        $user = User::where('email', $request->email)->where('user_id', null)->first();
        $principalUser = User::find($request->user_id);
        
        if($user && $user->id != $request->user_id){
            
            $user->user_id = $request->user_id;
            $user->save();
        }else{
            return redirect()->back()->with('warning', 'Usuário já vinculado ou inexistente, impossível vincular a este usuário');
        }
        return redirect()->back()->with('success', 'Usuário adicionado a rede com sucesso.');
    }

    public function delete(User $user)
    {
        try{
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.user.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        
        return redirect()->back()
        ->with('success', 'Usuário deletado com sucesso');
    }
}
