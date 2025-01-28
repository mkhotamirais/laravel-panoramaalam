<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogcat;
use App\Models\Carrental;
use App\Models\Carrentalcat;
use App\Models\Destinationblog;
use App\Models\Tourpackage;
use App\Models\Tourpackagecat;
use App\Models\Tourroute;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $latestThreeBlogs = Blog::latest()->take(4)->get();
        $destinationblogs = Destinationblog::all();
        return view('home', compact('latestThreeBlogs', 'destinationblogs'));
    }

    // Blog
    public function blog(Request $request)
    {
        $blogs = Blog::latest();
        $blogcats = Blogcat::all();
        $destinationblogs = Destinationblog::all();
        $sort_time = $request->sort;

        if ($sort_time === 'latest') {
            $blogs = Blog::latest();
        } else if ($sort_time === 'oldest') {
            $blogs = Blog::oldest();
        }

        $search = $request->search;
        if ($search) {
            $blogs = $blogs->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $blogs->paginate(8);

        return view('pages.blog.index', compact('blogs', 'search', 'blogcats', 'destinationblogs'));
    }

    public function userBlogs(User $user, Request $request)
    {
        $userBlogs = $user->blogs()->latest();
        $sort_time = $request->sort;

        if ($sort_time === 'latest') {
            $userBlogs = $user->blogs()->latest();
        } else if ($sort_time === 'oldest') {
            $userBlogs = $user->blogs()->oldest();
        }

        $search = $request->search;
        if ($search) {
            $userBlogs = $userBlogs->where('title', 'like', '%' . $request->search . '%');
        }

        $userBlogs = $userBlogs->paginate(8);

        return view('pages.blog.user-blog', compact('userBlogs', 'user', 'search'));
    }

    public function categoryBlogs(Blogcat $blogcat, Request $request)
    {
        $categoryBlogs = $blogcat->blogs()->latest();
        $sort_time = $request->sort;

        if ($sort_time === 'latest') {
            $categoryBlogs = $blogcat->blogs()->latest();
        } else if ($sort_time === 'oldest') {
            $categoryBlogs = $blogcat->blogs()->oldest();
        }

        $search = $request->search;
        if ($search) {
            $categoryBlogs = $categoryBlogs->where('title', 'like', '%' . $request->search . '%');
        }

        $categoryBlogs = $categoryBlogs->paginate(8);
        $blogcats = Blogcat::all();

        return view('pages.blog.cat-blog', compact('categoryBlogs', 'blogcat', 'blogcats', 'search'));
    }

    // Car Rental
    public function carrental(Request $request)
    {
        $carrentals = Carrental::latest();
        $carrentalcats = Carrentalcat::all();
        $destinationblogs = Destinationblog::all();
        $search = $request->search;
        $sort = $request->sort;
        $category_slug = $request->category;

        if ($sort === 'cheapest') {
            $carrentals = Carrental::orderBy('rental_price');
        } else if ($sort === 'most-expensive') {
            $carrentals = Carrental::orderByDesc('rental_price');
        }

        if ($search) {
            $carrentals = $carrentals->where('brand_name', 'like', "%$search%");
        }

        if ($category_slug) {
            $carrentals = $carrentals->whereHas('carrentalcat', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);  // Mencocokkan slug kategori
            });
        }

        $carrentals = $carrentals->paginate(8);

        return view('pages.car-rental.index', compact('carrentals', 'carrentalcats', 'search', 'destinationblogs', 'sort'));
    }

    // Tour Package
    public function tourpackage(Request $request)
    {
        $tourpackages = Tourpackage::latest();
        $tourpackagecats = Tourpackagecat::all();
        $destinationblogs = Destinationblog::all();
        $tourroutes = Tourroute::all();
        $selectedTourroutes = $request->input('tourroutes', []);
        $search = $request->search;
        $sort = $request->sort;
        $category_slug = $request->category;

        if ($sort === 'cheapest') {
            $carrentals = Tourpackage::orderBy('price');
        } else if ($sort === 'most-expensive') {
            $carrentals = Tourpackage::orderByDesc('price');
        }

        // opsi 1
        if ($selectedTourroutes) {
            $tourpackages->whereHas('tourroutes', function ($query) use ($selectedTourroutes) {
                $query->whereIn('tourroutes.slug', $selectedTourroutes);
            });
        }

        // // opsi 2
        // if ($selectedTourroutes) {
        //     $tourpackages = Tourpackage::when($selectedTourroutes, function ($query) use ($selectedTourroutes) {
        //         // Filter buku yang memiliki semua tourroute yang dipilih
        //         $query->whereHas('tourroutes', function ($query) use ($selectedTourroutes) {
        //             $query->whereIn('tourroutes.slug', $selectedTourroutes);
        //         }, '=', count($selectedTourroutes)); // Cek jumlah tourroute yang cocok harus sama dengan yang dipilih
        //     });
        // }

        if ($search) {
            $tourpackages = $tourpackages->where('name', 'like', "%$search%");
        }

        if ($category_slug) {
            $tourpackages = $tourpackages->whereHas('tourpackagecat', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);  // Mencocokkan slug kategori
            });
        }

        $tourpackages = $tourpackages->paginate(8);

        return view('pages.tour-package.index', compact('tourpackages', 'tourpackagecats', 'search', 'tourroutes', 'selectedTourroutes', 'destinationblogs'));
    }

    public function destinationblog(Request $request)
    {
        $destinationblogs = Destinationblog::latest();

        $search = $request->search;
        if ($search) {
            $destinationblogs = $destinationblogs->where('title', 'like', '%' . $request->search . '%');
        }

        $destinationblogs = $destinationblogs->paginate(8);

        return view('pages.destination-blog.index', compact('destinationblogs', 'search'));
    }
}
