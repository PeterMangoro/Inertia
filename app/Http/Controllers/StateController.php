<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\State;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class StateController extends Controller
{
    public function index(Countries $country)
    {
        $perPage = Request::input('perPage') ?: 5;

        return Inertia::render('Countries/States/Index', [
            'states' => State::query()
                ->where('countries_id', $country->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage']),
            'country' => $country
        ]);
    }

    public function edit(Countries $country, State $state)
    {
        return Inertia::render('Countries/States/Edit', [
            'country' => $country, 
            'state' => $state
        ]);
    }

    public function store(Countries $country)
    {
        $state = $country->states()->where('name', Request::input('name'))->exists();
        if ($state) {
            return Redirect::back()->with('flash.banner', 'City Exists.');
        }

       
            $validated = Request::validate([
                'country_id' => $country->id,
                'name'    => 'required',
                
            ]);
              
            $state->create($validated);
            return Redirect::back()->with('flash.banner', 'State created.');
           
    }
    public function update(Countries $country, State $state)
    {
        $validated = Request::validate([
            'name'    => 'required',
          
        ]);
        $state->update($validated);
        return Redirect::route('admin.states.index', $country->id)->with('flash.banner', 'State updated.');
    }

    public function destroy(Countries $country, State $state)
    {
        $state->delete();
        return Redirect::route('admin.states.index', $country->id)->with('flash.banner', 'State deleted.')->with('flash.bannerStyle', 'danger');
    }
}
