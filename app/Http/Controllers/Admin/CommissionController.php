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

        Commission::first()->update($data);
        return redirect()->back()
        ->with('success', 'Comissões Atualizadas');
    }
}
