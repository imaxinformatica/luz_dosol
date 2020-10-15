<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use App\Services\ServiceUser;
use App\State;
use Auth;

class ConfigurationController extends Controller
{
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

        $dataUser = ServiceUser::generateDatauser($request->all());
        $dataAddress = ServiceUser::generateDataAddress($request->all());

        try {
            $user->update($dataUser);
            $user->address()->update($dataAddress);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Dados Atualizados com sucesso');
    }

    public function changeAvatar(Request $request, ServiceUser $sv)
    {
        $request->validate([
            'avatar' => 'required'
        ]);

        $user = Auth::guard('user')->user();
        try {
            $data['avatar'] = ServiceUser::saveAvatar($request->file('avatar'), $user->id);
            $user->update($data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Foto de perfil Atualizada');
    }
}
