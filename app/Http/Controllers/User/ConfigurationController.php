<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use Auth;

class ConfigurationController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user')->user();
        return view('user.pages.configuration.index')
        ->with('user', $user);
    }

    public function update(ConfigurationRequest $request)
    {
        $user = Auth::guard('user')->user();
        $user->name = $request->name;
        $user->email = $request->email;

        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->back()->with('success', 'Dados Atualizados com sucesso');
    }
}
