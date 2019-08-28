<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ServiceBank;
use App\Bank;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('bank_code', 'asc')->get();
        return view('admin.pages.bank.index')
            ->with('banks', $banks);
    }

    public function store(Request $request, ServiceBank $sv)
    {
        $request->validate([
            'bank_name' => 'required',
            'bank_code' => 'required'
        ]);
        $msg = $sv->createBank($request->all());

        return redirect()->back()->with($msg);
    }

    public function update(Request $request, ServiceBank $sv)
    {
        $request->validate([
            'bank_code' => 'required',
            'bank_name' => 'required',
        ]);
        $msg = $sv->editBank($request->except('_token'));

        return redirect()->back()->with($msg);
    }
    public function delete(Bank $bank, ServiceBank $sv)
    {
        $msg = $sv->deleteBank($bank);

        return redirect()->back()->with($msg);
    }
}
