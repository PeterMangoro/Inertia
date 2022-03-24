<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Faker\Calculator\Inn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Shop/index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Shop/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'price'=>'required|string',
            'detail'=>'required|string',
            // 'image'=>'required|image|mimes:png,jpg,jpeg,gif,svg|max:6144',
        ]);
        if ($request->hasFile('image')){
            foreach($request->file('image') as $image)
            {
                $image_path= $request->file('image')->store('shop','public');
                $data[]=$image_path;
            }
        }
        $product = new Product;
        // $product ->image=json_encode($data);
        $product ->title = $request->title;
        $product ->price = $request->price;
        $product ->detail = $request->detail;
              
        $product->save();
        
        return back()->with('success','Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        return Inertia::render('Shop/product-details',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return Inertia::render('Shop/edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product= Product::find($id);
        $request->validate([
            'title'=>'required|string',
            'detail'=>'required|string',
            'image'=> 'required|image|mimes:png,jpg,jpeg,gif,svg|max:6144'  //3mb
        ]);
        if ($request->hasFile('image')){
            foreach($request->file('image') as $image)
            {
                $image_path = $request->file('image')->store('shop','public');  
                $data[] = $image_path;
            }
         
        }
       
        $product->image=json_encode($data);
        $product->title=$request->title;
        $product->detail=$request->detail;
        $product->price=$request->price;
        $product->update();

        return Redirect::route('products.edit');
        return with('success','Product Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success','Product deleted successfully');
    }

    /**
     * restore specific Product
     *
     * @return void
     */
    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();
  
        return redirect()->back();
    }  
  
    /**
     * restore all Product
     *
     * @return response()
     */
    public function restoreAll()
    {
        Product::onlyTrashed()->restore();
  
        return redirect()->back();
    }
}
