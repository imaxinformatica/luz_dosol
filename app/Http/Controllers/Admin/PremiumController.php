<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PremiumRequest;
use App\Premium;
use App\Services\ServicePremium;

class PremiumController extends Controller
{
    public function index()
    {
        $premiums = Premium::get();
        return view('admin.pages.premium.index')
            ->with('premiums', $premiums);
    }

    public function create()
    {
        return view('admin.pages.premium.create');
    }

    public function store(PremiumRequest $request, ServicePremium $sv)
    {
        try {
            $sv->findOrcreate($request->all(), $request->graduation);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ops, tivemos um problema, entre em contato com um de nosso administradores: ' 
            . $e->getMessage());
        }
        return redirect()->route('admin.premium.index')->with('success', 'Prêmio adicionado com sucesso');
    }

    public function edit(Premium $premium)
    {
        return view('admin.pages.premium.edit')
            ->with('premium', $premium);
    }

    public function update(PremiumRequest $request, ServicePremium $sv)
    {
        try {
            $sv->updatePremium($request->except('_token'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ops, tivemos um problema, entre em contato com um de nosso administradores: ' 
            . $e->getMessage());
        }
        return redirect()->route('admin.premium.index')->with('success', 'Prêmio atualizado com sucesso');
    }

    public function delete(Premium $premium, ServicePremium $sv)
    {
        try {
            $sv->deletePremium($premium);
        } catch (\Excepetion $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->route('admin.premium.index')->with('success', 'Prêmio removido com sucesso');
    }
}
