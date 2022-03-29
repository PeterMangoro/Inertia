<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;

        return Inertia::render('Products/Index', [
            'products' => Product::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%");
                })->when(Request::has('column'), function($query){
                    $query->orderBy(Request::input('column'), Request::input('direction'));
                })
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage', 'column', 'direction'])
        ]);
    }

    public function store()
    {
        Product::create([
            'title' => Request::input('productTitle'),
            'image' => "https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg",
            'price' => Request::input('productPrice'),
            'detail' => Request::input('productDetail'),
            
        ]);

        return Redirect::route('admin.products.index')->with('flash.banner', 'Tag Created.');

    }

    public function edit(Product $product)
    {
       return Inertia::render('Products/Edit', ['product' => $product]);
    }

    public function update(Product $product)
    {
        $validated = Request::validate([
            'title' => 'required',
            'image' => 'required',
            'price' => 'required',
            'detail' => 'required',
           
        ]);

        $product->update($validated);
        return Redirect::route('admin.products.index')->with('flash.banner', 'Product Updated.');
    }

    public function destroy(Product $product)
    {
        
        $product->delete();
        return Redirect::route('admin.products.index')->with('flash.banner', 'Product Deleted.')->with('flash.bannerStyle', 'danger');
    }
}

