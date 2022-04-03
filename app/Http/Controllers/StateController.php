<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\State;
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
}
