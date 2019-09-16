<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\ServiceCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = new Category();
        $categories = $categories->orderBy('name', 'asc')->paginate(20);

        return view('admin.pages.category.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }
    public function store(CategoryRequest $request, ServiceCategory $sv)
    {
        $data =$request->all();
        try {
            $sv->createCategory($data);
        } catch (\Excepetion $e) {
            return redirect()->back()
            ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->route('admin.category.index')->with('success', 'Categoria criada com sucesso');
    }

    public function edit(Category $category)
    {
        return view('admin.pages.category.edit')
        ->with('category', $category);
    }

    public function update(CategoryRequest $request, ServiceCategory $sv, Category $category)
    {
        $data = $request->except('_token');
        try {
            $sv->updateCategory($data, $category);
        } catch (\Excepetion $e) {
            return redirect()->back()
            ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->route('admin.category.index')->with('success', 'Categoria alterada com sucesso');
    }

    public function delete(ServiceCategory $sv, Category $category)
    {
        try {
            $sv->deleteCategory( $category);
        } catch (\Excepetion $e) {
            return redirect()->back()
            ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos administradores: ' . $e->getMessage());
        }
        return redirect()->route('admin.category.index')->with('success', 'Categoria removida com sucesso');
    }
}
