<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\State;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

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
}
