<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommissionRequest;
use App\Services\ServiceCommission;
use App\Commission;

class CommissionController extends Controller
{
    public function edit()
    {
        $commission = Commission::first();
        return view('admin.pages.commission.edit')
        ->with('commission', $commission);
    }

    public function update(CommissionRequest $request, ServiceCommission $service)
    {
        $data = $service->validateDataService($request->except('_token'));
        $total = array_sum($data);
        if($total > 25){
            return redirect()->back()
            ->with('error','O valor de comissões está superior a 25%.');
        }
        try {
            Commission::first()->update($data);
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->back()
        ->with('success', 'Comissões Atualizadas');
    }
}
