<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Bank;
use App\Databank;
use App\Models\PixKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinancialRequest;

class FinancialController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('user')->user();

        $dataBank = $user->dataBank;
        $pixKey = $user->pixKeys()->first();
        if(!$pixKey){
            $pixKey =new PixKey(); 
        }

        $banks = Bank::get();
        return view('user.pages.financial.edit')
            ->with('banks', $banks)
            ->with('pixKey', $pixKey)
            ->with('dataBank', $dataBank);
    }

    public function update(FinancialRequest $request)
    {
        $dataBank = Databank::find($request->databank_id);
        $data = $request->except('_token', 'databank_id');
        try {
            $dataBank->update($data);
            $pixKey = PixKey::where('user_id', $dataBank->user_id)->first();
            if($pixKey){
                $pixKey->update([
                    'key' => $data['key'],
                    'type' => $data['type'],
                ]);
            }else{
                if(isset($data['type'])){
                    PixKey::create([
                        'key' => $data['key'],
                        'type' => $data['type'],
                        'user_id' => $dataBank->user_id,
                    ]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Dados Bancários atualizados');
    }
}
