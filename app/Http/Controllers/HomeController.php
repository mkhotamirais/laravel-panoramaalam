<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // app()->setLocale(session('locale'));

        $latestThreeBlogs = Blog::latest()->take(3)->get();
        return view('home', compact('latestThreeBlogs'));
    }

    public function blogWisata(Request $request)
    {
        $blogs = Blog::latest();

        $search = $request->search;
        if ($search) {
            $blogs = $blogs->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $blogs->paginate(6);
        return view('blog-wisata', compact('blogs', 'search'));
    }

    public function userBlogs(User $user, Request $request)
    {
        $userBlogs = $user->blogs()->latest();

        $search = $request->search;
        if ($search) {
            $userBlogs = $userBlogs->where('title', 'like', '%' . $request->search . '%');
        }

        $userBlogs = $userBlogs->paginate(6);

        return view('dashboard.blog-wisata.user-blogs', compact('userBlogs', 'user', 'search'));
    }

    public function categoryBlogs(BlogCategory $blogCategory, Request $request)
    {
        $categoryBlogs = $blogCategory->blogs();

        $search = $request->search;
        if ($search) {
            $categoryBlogs = $categoryBlogs->where('title', 'like', '%' . $request->search . '%');
        }

        $categoryBlogs = $categoryBlogs->paginate(6);

        return view('dashboard.blog-categories.category-blogs', compact('categoryBlogs', 'blogCategory', 'search'));
    }

    public function paketWisata()
    {
        return view('paket-wisata');
    }

    public function sewaMobil()
    {
        return view('sewa-mobil');
    }
}
