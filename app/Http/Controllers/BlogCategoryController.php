<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogCategories = BlogCategory::latest()->get();
        return view('dashboard.blog-categories.index', compact('blogCategories'));
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
            'name' => 'required|string|max:255'
        ]);

        $slug = Str::slug($fields['name']);

        BlogCategory::create([
            'name' => $fields['name'],
            'slug' => $slug
        ]);

        // return redirect()->route('blog-categories.index')->with('success', 'Blog Category created successfully');
        return back()->with('success', 'Blog Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $slug = Str::slug($fields['name']);

        $blogCategory->update([
            'name' => $fields['name'],
            'slug' => $slug
        ]);

        return back()->with('success', 'Blog Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();

        return back()->with('delete', 'Blog Category deleted successfully');
    }
}
