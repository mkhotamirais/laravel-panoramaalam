<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CarRental;
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

    public function userCarRentals(User $user, Request $request)
    {
        $userCarRentals = $user->carRentals()->latest();

        $search = $request->search;
        if ($search) {
            $userCarRentals = $userCarRentals->where('title', 'like', '%' . $request->search . '%');
        }

        $userCarRentals = $userCarRentals->paginate(6);

        return view('dashboard.sewa-mobil.user-sewas', compact('userCarRentals', 'user', 'search'));
    }

    public function categoryCarRentals(CarRental $carRental, Request $request)
    {
        $categoryCarRentals = $carRental->blogs();

        $search = $request->search;
        if ($search) {
            $categoryCarRentals = $categoryCarRentals->where('title', 'like', '%' . $request->search . '%');
        }

        $categoryCarRentals = $categoryCarRentals->paginate(6);

        return view('dashboard.sewa-mobil-categories.category-sewas', compact('categoryCarRentals', 'carRental', 'search'));
    }
}
