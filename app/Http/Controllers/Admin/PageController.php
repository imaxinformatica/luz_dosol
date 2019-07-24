<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.page.index')->with('pages', $pages);
    }

    public function edit(Page $page)
    {
        return view('admin.pages.page.edit')->with('page',$page);
    }

    public function update()
    {

    }   

}
