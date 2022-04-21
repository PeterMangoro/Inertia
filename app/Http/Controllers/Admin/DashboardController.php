<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Countries;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $countries = Countries::all()->count();
        $users = User::all()->count();
        $blogs = Blog::all()-> count();
        $products = Product::all()->count();


        return Inertia::render('Admin/Index',[
            'num_countries'=>$countries,
            'num_users'=>$users,
            'num_blogs'=>$blogs,
            'num_products'=>$products]);
    }
}
