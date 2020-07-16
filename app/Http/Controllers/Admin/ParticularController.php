<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParticularRequest;
use App\ParticularShip;
use App\Services\ParticularService;
use App\Services\ServiceCategory;

class ParticularController extends Controller
{
    public function index()
    {
        $particulares = new ParticularShip();
        $particulares = $particulares->paginate(20);

        return view('admin.pages.particular.index')
            ->with('particulares', $particulares);
    }

    public function create()
    {
        return view('admin.pages.particular.create');
    }
    public function store(ParticularRequest $request)
    {
        $data = $request->all();
        try {
            ParticularService::create($data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->route('admin.particular.index')->with('success', 'Frete adicionado com sucesso');
    }

    public function edit(ParticularShip $particular)
    {
        return view('admin.pages.particular.edit')
            ->with('particular', $particular);
    }

    public function update(ParticularRequest $request, ParticularShip $particular)
    {
        $data = $request->except('_token');
        try {
            ParticularService::update($data, $particular);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->back()
            ->with('success', 'Dados alterados com sucesso');
    }

    public function delete(ParticularShip $particular)
    {
        try {
            ParticularService::delete($particular);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->back()
        ->with('success', 'Dados removidos com sucesso');
    }
}
