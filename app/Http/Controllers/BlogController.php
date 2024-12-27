<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Pest\Laravel\post;

class BlogController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['store']),
            // new Middleware('auth', except: ['index', 'store']),
            new Middleware('auth'),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        $myBlogs = Blog::where('user_id', Auth::id())->latest()->paginate(3);

        return view('dashboard.blog-wisata.index', compact('blogs', 'myBlogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogCategories = BlogCategory::all();
        return view('dashboard.blog-wisata.create', compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'blogCategory' => 'required|integer|exists:blog_categories,id'
        ]);

        $slug = Str::slug($fields['title']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('blogs_images', $request->image);
        }

        // Create blog
        // $blog = Blog::create([...$fields, 'user_id' => Auth::id()]);
        // Auth::user()->blogs()->create($fields);
        Auth::user()->blogs()->create([
            'title' => $request->title,
            'slug' => $slug,
            'body' => $request->body,
            'image' => $path,
            'blog_category_id' => $request->blogCategory
        ]);

        // Redirect
        // return back()->with('success', 'Blog created successfully');
        return redirect('/blogs')->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(blog $blog)
    {
        $latestThreeBlogs = Blog::latest()->where('id', '!=', $blog->id)->take(3)->get();
        return view('dashboard.blog-wisata.show', compact('blog', 'latestThreeBlogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        // authorize
        Gate::authorize('modify', $blog);
        return view('dashboard.blog-wisata.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, blog $blog)
    {
        // authorize
        Gate::authorize('modify', $blog);

        // Validate
        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024'

        ]);

        // Upload image if file exist
        $path = $blog->image ?? null;
        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $path = Storage::disk('public')->put('blogs_images', $request->image);
        }
        // Update the blog
        $blog->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

        // Redirect
        // return back()->with('success', 'Blog updated successfully');
        return redirect('/blogs')->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blog $blog)
    {
        // authorize
        Gate::authorize('modify', $blog);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return back()->with('delete', 'Blog deleted successfully');
    }
}
