<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class CountriesController extends Controller
{
    public function index()
    {
        $perPage = Request::input('perPage') ?: 15;

        return Inertia::render('Countries/Index', [
            'countries' => Countries::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })->when(Request::has('column'), function($query){
                    $query->orderBy(Request::input('column'), Request::input('direction'));
                })
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage', 'column', 'direction'])
        ]);

        
    }

    public function show($id)
    {
        $country=Countries::find($id);
        return Inertia::render('Shop/country-details',compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Countries::find($id);
        return Inertia::render('Shop/edit',compact('country'));
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
        $country= Countries::find($id);
        $request->validate([
            'title'=>'required|string',
            'detail'=>'required|string',
            'price'=>'required|string',
            // 'image'=> 'required|image|mimes:png,jpg,jpeg,gif,svg|max:6144'  //3mb
        ]);
        if ($request->hasFile('image')){
            foreach($request->file('image') as $image)
            {
                $image_path = $request->file('image')->store('shop','public');  
                $data[] = $image_path;
            }
         
        }
       
        // $country->image=json_encode($data);
        $country->title=$request->title;
        $country->detail=$request->detail;
        $country->price=$request->price;
        // dd($country);
        $country->update();

        // return Redirect::route('products.edit',$country.id);
        return back()-> with('success','Countries Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Countries::find($id);
        $country->delete();
        return redirect()->back()->with('success','Countries deleted successfully');
    }

    /**
     * restore specific Countries
     *
     * @return void
     */
    public function restore($id)
    {
        Countries::withTrashed()->find($id)->restore();
  
        return redirect()->back();
    }  
  
    /**
     * restore all Countries
     *
     * @return response()
     */
    public function restoreAll()
    {
        Countries::onlyTrashed()->restore();
  
        return redirect()->back();
    }
}
