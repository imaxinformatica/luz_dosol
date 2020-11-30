<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PaymentsExport;
use App\Exports\TransfeeraExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ServiceOrder;
use App\Services\ReportService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User};

class ExportController extends Controller
{

    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function index()
    {
        $user =  User::first();
        $userDate = date("d-m-Y", strtotime($user->created_at));
        $actualDate = date("d-m-Y");

        $dates = datasArray($userDate, $actualDate);

        return view('admin.pages.export.index')
            ->with('dates', $dates);
    }

    public function generate(Request $request)
    {
        $date = explode("/",$request->cycle);
        
        $data = $this->reportService->generate($date);
        return Excel::download(new PaymentsExport($data), "Relatório de pagamento-{$date[0]}-{$date[1]}.xlsx");
    }

    public function transfeera(Request $request, ServiceOrder $sv)
    {
        $date = explode("/",$request->cycle);
        
        $data = $this->reportService->transfeera($date);
        return Excel::download(new TransfeeraExport($data), "Relatório transfeera-{$date[0]}-{$date[1]}.xlsx");
    }

}
