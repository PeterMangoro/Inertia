<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class BlogsController extends Controller
{
    public function index()
    {
        $perPage = Request::input('perPage') ?: 15;

        return Inertia::render('Blogs/Index', [
            'blogs' => Blog::query()
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

    public function create()
    {
        return Inertia::render('Blogs/Create');
    }

    public function store()
    {
        Blog::create([
            'title' => Request::input('blogTitle'),
            'image' => "https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg",
             'author' => Request::input('blogAuthor'),
            'detail' => Request::input('blogDetail'),
            'is_public' => false,
        ]);

        return Redirect::route('admin.blogs.index')->with('flash.banner', 'Tag Created.');

    }

    public function edit(Blog $blog)
    {
       return Inertia::render('Blogs/Edit', ['blog' => $blog]);
    }

    public function update(Blog $blog)
    {
        $validated = Request::validate([
            'title' => 'required',
            'image' => 'required',
            
            'detail' => 'required',
            'is_public' => 'required'
           
        ]);

        $blog->update($validated);
        return Redirect::route('admin.blogs.index')->with('flash.banner', 'Blog Updated.');
    }

    public function destroy(Blog $blog)
    {
        
        $blog->delete();
        return Redirect::route('admin.blogs.index')->with('flash.banner', 'Blog Deleted.')->with('flash.bannerStyle', 'danger');
    }
}
