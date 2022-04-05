<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\State;
use App\Models\Cities;
use App\Models\Countries;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class CitiesController extends Controller
{
    public function Index(Countries $country, State $state)
    {
       
        $perPage = Request::input('perPage') ?: 15;

        return Inertia::render('Countries/States/Cities/Index', [
            'cities' => Cities::query()
                ->where('state_id', $state->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage']),
            'country' => $country,
            'state' => $state
        ]);
    }

    public function store(Countries $country, State $state)
    {
        $city = $state->cities()->where('name', Request::input('name'))->exists();
        if ($city) {
            return Redirect::back()->with('flash.banner', 'City Exists.');
        }
       
        $validated = Request::validate([
            'state_id' => $state->id,
            'name'    => 'required',
            
        ]);
        $city->create($validated);
            return Redirect::back()->with('flash.banner', 'City created.');
        
    }

    public function edit(Countries $country, State $state, Cities $city)
    {
        return Inertia::render('Countries/States/Cities/Edit', [
            'country' => $country,
            'state' => $state,
            'city' => $city
        ]);
    }

    public function update(Countries $country, State $state, Cities $city)
    {
        $validated = Request::validate([
            'name'    => 'required',
            
        ]);
        $city->update($validated);
        return Redirect::route('admin.cities.index', [$country->id, $state->id])->with('flash.banner', 'City updated.');
 
    }

    public function destroy(Countries $country, State $state, Cities $city)
    {
        $city->delete();
        return Redirect::route('admin.cities.index', [$country->id, $state->id])->with('flash.banner', 'City deleted.')->with('flash.bannerStyle', 'danger');
    }
}

