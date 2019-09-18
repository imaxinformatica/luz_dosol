<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PaymentsExport;
use App\Exports\TransfeeraExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ServiceOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User};

class ExportController extends Controller
{
    public function index()
    {
        $user =  User::first();
        $userDate = date("d-m-Y", strtotime($user->created_at));
        $actualDate = date("d-m-Y");

        $dates = datasArray($userDate, $actualDate);

        return view('admin.pages.export.index')
            ->with('dates', $dates);
    }

    public function generate(Request $request, ServiceOrder $sv)
    {
        $date = explode("/",$request->cycle);
        
        $data = $sv->generateReport($date);
        return Excel::download(new PaymentsExport($data), 'Relatório de pagamento.xlsx');
    }

    public function transfeera(Request $request, ServiceOrder $sv)
    {
        $date = explode("/",$request->cycle);
        
        $data = $sv->transfeeraReport($date);
        return Excel::download(new TransfeeraExport($data), 'Relatório de pagamento.xlsx');
    }

}
