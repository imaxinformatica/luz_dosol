<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;

class DashboardController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 1)->get();
        return view('admin.pages.dashboard.index')
        ->with('banners', $banners);
    }
}
