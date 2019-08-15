<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Services\ServiceBanner;
use App\Banner;
class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.pages.banner.index')->with('banners', $banners);
    }

    public function create()
    {
        return view('admin.pages.banner.create');
    }

    public function store(BannerRequest $request, ServiceBanner $service)
    {
        $data = $request->except('_token');
        try {
            $data['file'] = $service->saveImage($request->file('file'), $request->description);
            Banner::create($data);
        } catch (\Exception $e) {
            return redirect()->route('admin.banner.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }

        return redirect()->route('admin.banner.index')
        ->with('success', 'Banner adicionado com sucesso');
    }

    public function status(Banner $banner)
    {
        $banner->update([
            'status' => $banner->status == 1 ? 0 : 1,
        ]);
        return redirect()->route('admin.banner.index')
        ->with('success', 'Status alterado com sucesso');
    }
    
    public function edit(Banner $banner)
    {
        return view('admin.pages.banner.edit')
        ->with('banner', $banner);
    }

    public function update(BannerRequest $request)
    {
        $data = $request->except('_token', 'banner_id');
        try {
            if($request->file('file')){
                $data['file'] = $service->saveImage($request->file('file'), $request->description);
            }
            Banner::find($request->banner_id)->update($data);
        } catch (\Exception $e) {
            return redirect()->route('admin.banner.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }

        return redirect()->route('admin.banner.index')
        ->with('success', 'Banner alterado com sucesso');
    }

    public function delete(Banner $banner)
    {
        try{
            $banner->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.banner.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        
        return redirect()->back()
        ->with('success', 'Banner deletado com sucesso');
    }


}
