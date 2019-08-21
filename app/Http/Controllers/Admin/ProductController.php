<?php

namespace App\Http\Controllers\Admin;

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
        $products = $products->orderBy('reference', 'asc')->paginate(20);
        
        return view('admin.pages.product.index')
        ->with('products', $products); 
    }

    public function create()
    {
        return view('admin.pages.product.create');
    }

    public function store(ProductRequest $request, ServiceProduct $service)
    {
        $data = $request->except('_token');
        try {
            $data['file'] = $service->saveImage($request->file('file'), $request->name);
            $data['price'] = convertMoneyBraziltoUSA($request->price);
            Product::create($data);
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        return redirect()->route('admin.product.index')
        ->with('success', 'Produto adicionado com sucesso');
    }

    public function edit(Product $product)
    {
        return view('admin.pages.product.edit')
        ->with('product', $product);
    }

    public function update(ProductRequest $request, ServiceProduct $service, Product $product)
    {
        $data = $request->except('_token', 'product_id');
        try {
            if($request->file('file')){
                $data['file'] = $service->saveImage($request->file('file'), $request->name);
            }
            $data['price'] = convertMoneyBraziltoUSA($request->price);
            $product->update($data);
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
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
        try{
            $product->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }
        
        return redirect()->back()
        ->with('success', 'Produto deletado com sucesso');
    }

}
