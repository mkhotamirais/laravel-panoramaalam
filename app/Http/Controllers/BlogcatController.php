<?php

namespace App\Http\Controllers;

use App\Models\Blogcat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBlogcatRequest;


class BlogcatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogCats = Blogcat::latest()->get();
        return view('dashboard.blog.blog-cat', compact('blogCats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:blogcats',
        ]);

        $slug = Str::slug($request->name);

        Blogcat::create([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Blog category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blogcat $blogcat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blogcat $blogcat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blogcat $blogcat)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:blogcats',
        ]);

        $slug = Str::slug($request->name);

        $blogcat->update([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Blog category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogcat $blogcat)
    {
        if ($blogcat->id === 1) {
            return back()->with('error', 'Default category cannot be deleted.');
        }
        $blogcat->delete();
        return back()->with('success', 'Blog category deleted successfully');
    }
}
