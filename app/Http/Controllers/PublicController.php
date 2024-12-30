<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogcat;
use App\Models\Carrental;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $latestThreeBlogs = Blog::latest()->take(3)->get();
        // dd('halo', $latestThreeBlogs);
        return view('home', compact('latestThreeBlogs'));
    }

    // Blog
    public function blog(Request $request)
    {
        $blogs = Blog::latest();

        $search = $request->search;
        if ($search) {
            $blogs = $blogs->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $blogs->paginate(6);
        return view('pages.blog.index', compact('blogs', 'search'));
    }

    public function userBlogs(User $user, Request $request)
    {
        $userBlogs = $user->blogs()->latest();

        $search = $request->search;
        if ($search) {
            $userBlogs = $userBlogs->where('title', 'like', '%' . $request->search . '%');
        }

        $userBlogs = $userBlogs->paginate(6);

        return view('pages.blog.user-blog', compact('userBlogs', 'user', 'search'));
    }

    public function categoryBlogs(Blogcat $blogcat, Request $request)
    {
        $categoryBlogs = $blogcat->blogs();

        $search = $request->search;
        if ($search) {
            $categoryBlogs = $categoryBlogs->where('title', 'like', '%' . $request->search . '%');
        }

        $categoryBlogs = $categoryBlogs->paginate(6);

        return view('pages.blog.cat-blog', compact('categoryBlogs', 'blogcat', 'search'));
    }

    // Car Rental
    public function carRental(Request $request)
    {
        $carrentals = Carrental::latest();
        $search = $request->search;

        if ($search) {
            $carrentals = $carrentals->where('brand_name', 'like', '%' . $request->search . '%');
        }

        $carrentals = $carrentals->paginate(6);

        return view('pages.car-rental.index', compact('carrentals', 'search'));
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

    // Tour Package
    public function tourPackage()
    {
        return view('pages.tour-package.index');
    }
}
