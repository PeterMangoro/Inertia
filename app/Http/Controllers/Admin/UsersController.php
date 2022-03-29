<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
       $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Users/Index',[
            'users'=> User::query()
                    ->when(Request::input('search'), function($query,$search){
                        $query->where('name','like',"%{$search}%");
                    })
                    ->paginate($perPage)
                    ->withQueryString(),
            'filters' => Request::only(['search','perPage'])
        ]);            
        
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('admin.users.index')->with('flash.banner', 'User deleted.')->with('flash.bannerStyle', 'danger');
    }
}
