<?php

namespace App\Http\Controllers\User;

use Auth;
use App\State;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;

class ConfigurationController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $user = Auth::guard('user')->user();
        $states = State::orderBy('name','asc')->get();
        return view('user.pages.configuration.index')
            ->with('states', $states)
            ->with('user', $user);
    }

    public function update(ConfigurationRequest $request)
    {
        $user = Auth::guard('user')->user();
        $userService = new UserService();
        $dataUser = $userService->generateDataUser($request->all());
        $dataAddress = $userService->generateDataAddress($request->all());

        try {
            $user->update($dataUser);
            $user->address()->update($dataAddress);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Dados Atualizados com sucesso');
    }

    public function changeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required'
        ]);

        $user = Auth::guard('user')->user();
        try {
            $data['avatar'] = $this->userService->avatar($request->file('avatar'), $user->id);
            $user->update($data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Foto de perfil Atualizada');
    }
}
