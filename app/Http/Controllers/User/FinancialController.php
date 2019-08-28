<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinancialRequest;
use App\Databank;
use App\Bank;
use Auth;

class FinancialController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('user')->user();

        $dataBank = $user->databank;
        $banks = Bank::get();
        return view('user.pages.financial.edit')
        ->with('banks', $banks)
        ->with('dataBank', $dataBank);
    }

    public function update(FinancialRequest $request)
    {
        $databank = Databank::find($request->databank_id);
        $data = $request->except('_token', 'databank_id');
        try {
            $databank->update($data);
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->back()->with('success', 'Dados Bancários atualizados');
    }
}
