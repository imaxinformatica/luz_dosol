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
        $user = Auth::guard('user')->user();
        $banners = Banner::where('status', 1)->get();
        return view('user.pages.dashboard.index')
        ->with('user', $user)
        ->with('banners', $banners);
    }
}
