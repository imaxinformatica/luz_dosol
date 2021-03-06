<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\State;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = new User;

        if ($request->has('id')) {
            if (request('id') != '') {
                $users = $users->where('id', request('id'));
            }
        }
        if ($request->has('name')) {
            if (request('name') != '') {
                $users = $users->where('name', 'like', request('name') . '%');
            }
        }
        if ($request->has('email')) {
            if (request('email') != '') {
                $users = $users->where('email', 'like', request('email') . '%');
            }
        }
        $users = $users->orderBy('id', 'asc')->paginate(20);
        return view('admin.pages.user.index')->with('users', $users);
    }

    public function create()
    {
        $states = State::orderBy('name', 'asc')->get();
        $banks = Bank::orderBy('bank_name', 'asc')->get();
        return view('admin.pages.user.create')
            ->with('banks', $banks)
            ->with('states', $states);
    }

    public function store(UserRequest $request)
    {
        try {
            $this->userService->create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Usuário adicionado.');
    }

    public function edit(User $user)
    {
        $states = State::orderBy('name', 'asc')->get();
        $banks = Bank::get();
        return view('admin.pages.user.edit')
            ->with('states', $states)
            ->with('banks', $banks)
            ->with('user', $user);
    }

    public function update(User $user, UserRequest $request)
    {
        try {
            $this->userService->update($request->all(), $user);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()
            ->back()
            ->with('success', 'Usuário atualizado.');
    }

    public function status(User $user)
    {
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return redirect()
            ->back()
            ->with('success', 'Status atualizado.');
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find($request->user_id);

        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()
            ->back()
            ->with('success', 'Senha alterada com sucesso.');

    }

    public function attach(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'user_id' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('user_id', null)->first();
        $principalUser = User::find($request->user_id);

        if ($user && $user->id != $request->user_id) {

            $user->user_id = $request->user_id;
            $user->save();
        } else {
            return redirect()->back()->with('warning', 'Usuário já vinculado ou inexistente, impossível vincular a este usuário');
        }
        return redirect()->back()->with('success', 'Usuário adicionado a rede com sucesso.');
    }

    public function network(User $user)
    {
        $user->children = \listChildren($user, 10);

        return view('admin.pages.user.network')
            ->with('user', $user);
    }

    public function delete(User $user)
    {
        try {
            $user->dataBank()->delete();
            $user->address()->delete();
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->back()
            ->with('success', 'Usuário deletado com sucesso');
    }
}
