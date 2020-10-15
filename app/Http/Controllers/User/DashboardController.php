<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Premium;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user =  Auth::guard('user')->user();
        $userDate = date("d-m-Y", strtotime($user->created_at));
        $premiums = Premium::get();

        $dates = datasArray($userDate);
        $banners = Banner::where('status', 1)->get();
        return view('user.pages.dashboard.index')
            ->with('premiums', $premiums)
            ->with('user', $user)
            ->with('dates', $dates)
            ->with('banners', $banners);
    }

    public function getBonus(Request $request)
    {
        $user =  Auth::guard('user')->user();
        $isActive = $user->getActive($request->month, $request->year);
        $data['bonus'] = !$isActive ? "-" : convertMoneyUSAtoBrazil($user->getBonusNotIndication($request->month, $request->year));
        $data['special_bonus'] = !$isActive ? "-" : convertMoneyUSAtoBrazil($user->getBonusIndication($request->month, $request->year));
        $data['commission'] = !$isActive ? "-" :convertMoneyUSAtoBrazil($user->getCommission($request->month, $request->year));
        $data['total'] = !$isActive ? "-" :convertMoneyUSAtoBrazil($user->getTotalBonus($request->month, $request->year));
        return view('user.parts.bonus')->with('data', $data);
    }
}
