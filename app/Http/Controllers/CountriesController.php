<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Support\Facades\Redirect;
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
                })
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage'])
        ]);

        
    }

    public function store(Countries $country)
    {
         $country = Countries::where('name', Request::input('name'))->first();
        if ($country) {
            return Redirect::back()->with('flash.banner', 'Country already Exists.');
        }

        $validated = Request::validate([
            'name'    => 'required',
            'iso3' => 'required',
            'phonecode' => 'required',
            'capital' => 'required',
            'currency' => 'required',
        ]);
          
        $country->create($validated);
        return Redirect::route('admin.countries.index')->with('flash.banner', 'Country added.');
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
    public function edit(Countries $country)
    {
        
        return Inertia::render('Countries/Edit',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Countries $country)
    {
        $validated = Request::validate([
            'name'    => 'required',
            'iso3' => 'required',
            'phonecode' => 'required',
            'capital' => 'required',
            'currency' => 'required',
        ]);

        $country->update($validated);
        return Redirect::route('admin.countries.index')->with('flash.banner', 'Country updated.');
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countries $country)
    {
        $country->delete();
        return Redirect::route('admin.countries.index')->with('flash.banner', 'Countries deleted.')->with('flash.bannerStyle', 'danger');
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
