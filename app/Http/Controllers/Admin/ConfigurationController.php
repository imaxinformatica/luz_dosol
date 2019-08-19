<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use App\Cycle;
use Auth;

class ConfigurationController extends Controller
{
    public function index()
    {
        $cycle = Cycle::first();
        $user = Auth::guard('admin')->user();
        return view('admin.pages.configuration.index')
        ->with('user', $user)
        ->with('cycle', $cycle);
    }

    public function update(ConfigurationRequest $request)
    {
        $user = Auth::guard('admin')->user();
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

    public function cycle(Request $request)
    {
        $request->validate([
            'price' => 'required'
        ]);
        $data['price'] = convertMoneyBraziltoUSA($request->price);
        try {
            Cycle::first()->update($data);
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->back()->with('success', 'Dados Atualizados com sucesso');

    } 
}
