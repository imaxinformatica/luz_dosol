<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
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

    public function update(PageRequest $request, Page $page)
    {
        $data = $request->except('_token', 'page_id', '_wysihtml5_mode');
        try {
            $page->update($data);
        } catch (\Exception $e) {
            return redirect()->route('admin.pages.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->route('admin.pages.index')->with('success', 'Dados alterados com sucesso.');

    }   

}
