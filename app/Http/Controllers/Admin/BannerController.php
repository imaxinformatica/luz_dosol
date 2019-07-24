<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
class BannerController extends Controller
{
    public function index()
    {
        return view('admin.pages.banner.index')->with('banners', Banner::all());
    }

    public function create()
    {
        return view('admin.pages.banner.create');
    }

    public function edit()
    {
        return view('admin.pages.banner.edit');
    }


}
