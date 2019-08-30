<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $user =  Auth::guard('user')->user();
        $userDate = date("d-m-Y", strtotime($user->created_at));
        $actualDate = date("d-m-Y");

        $dates = datasArray($userDate, $actualDate);
        $banners = Banner::where('status', 1)->get();
        return view('user.pages.dashboard.index')
            ->with('user', $user)
            ->with('dates', $dates)
            ->with('banners', $banners);
    }

    public function getBonus(Request $request)
    {
        $user =  Auth::guard('user')->user();

        $data['bonus'] = convertMoneyUSAtoBrazil($user->getBonus($request->month, $request->year));
        $data['commission'] = convertMoneyUSAtoBrazil($user->getCommission($request->month, $request->year));
        $data['total'] = convertMoneyUSAtoBrazil($user->getBonus($request->month, $request->year) + $user->getCommission($request->month, $request->year));
        return $data;
    }
}
