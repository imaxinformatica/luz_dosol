<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ServiceProduct;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = new Product;
        if ($request->has('name')) {
            if (request('name') != '') {
                $products = $products->where('name', 'like', '%' . request('name') . '%');
            }
        }
        if ($request->has('reference')) {
            if (request('reference') != '') {
                $products = $products->where('reference', 'like', '%' . request('reference') . '%');
            }
        }
        if ($request->has('category_id')) {
            if (request('category_id') != '') {
                $products = $products->where('category_id', request('category_id'));
            }
        }
        $products = $products->orderBy('reference', 'asc')->paginate(20);

        return view('admin.pages.product.index')
            ->with('categories', Category::get())
            ->with('products', $products);
    }

    public function create()
    {
        $categories = Category::get();
        return view('admin.pages.product.create')
            ->with('categories', $categories);
    }

    public function store(ProductRequest $request, ServiceProduct $service)
    {
        $data = $request->except('_token');
        try {
            $service->createProduct($data);
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: ' . $e->getMessage());
        }
        return redirect()->route('admin.product.index')
            ->with('success', 'Produto adicionado com sucesso');
    }

    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('admin.pages.product.edit')
            ->with('categories', $categories)
            ->with('product', $product);
    }

    public function update(ProductRequest $request, ServiceProduct $service, Product $product)
    {
        $data = $request->except('_token', 'product_id');
        try {
            $service->updateProduct($data, $product);
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: ' . $e->getMessage());
        }
        return redirect()->route('admin.product.index')
            ->with('success', 'Produto alterado com sucesso');
    }

    public function status(Product $product)
    {
        $product->update([
            'status' => $product->status == 1 ? 0 : 1,
        ]);
        return redirect()->route('admin.product.index')
            ->with('success', 'Status alterado com sucesso');
    }

    public function delete(Product $product)
    {
        try {
            $product->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')
                ->with('error', 'Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Produto deletado com sucesso');
    }
}
