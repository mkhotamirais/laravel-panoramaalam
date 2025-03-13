<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogcat;
use App\Models\Carrental;
use App\Models\Carrentalcat;
use App\Models\Tourpackage;
use App\Models\Tourpackagecat;
use App\Models\Tourroute;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // $latestThreeBlogs = Blog::latest()->take(4)->get();
        $latestThreeBlogs = Blog::with('blogcat')
            ->whereDoesntHave('blogcat', function ($query) {
                $query->where('slug', 'destinasi');
            })->latest()->take(4)->get();
        $destinationblogs = Blog::with('blogcat')->whereHas('blogcat', function ($query) {
            $query->where('slug', 'destinasi');
        })->latest()->get();

        $carrentals = Carrental::orderBy('rental_price')->get();
        $tourpackages = Tourpackage::orderBy('price')->get();
        return view('home', compact('latestThreeBlogs', 'destinationblogs', 'carrentals', 'tourpackages'));
    }

    // Blog
    public function blog(Request $request)
    {
        $blogs = Blog::latest();
        $destinationblogs = Blog::with('blogcat')->whereHas('blogcat', function ($query) {
            $query->where('slug', 'destinasi');
        })->latest()->get();
        $blogcats = Blogcat::all();
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

    // Car Rental
    public function carrental(Request $request)
    {
        $carrentals = Carrental::all();
        $carrentalcats = Carrentalcat::all();
        $search = $request->search;
        $sort = $request->sort ?? "cheapest";
        $category_slug = $request->category;
        $destinationblogs = Blog::with('blogcat')->whereHas('blogcat', function ($query) {
            $query->where('slug', 'destinasi');
        })->latest()->get();

        // Mulai query dengan mengutamakan kategori "lepas kunci"
        $carrentals = Carrental::with('carrentalcat')
            ->select('carrentals.*')
            ->join('carrentalcats', 'carrentals.carrentalcat_id', '=', 'carrentalcats.id')
            ->orderByRaw("CASE WHEN carrentalcats.slug = 'lepas-kunci' THEN 0 ELSE 1 END,
            carrentals.rental_price ASC");

        if ($sort === 'cheapest') {
            $carrentals = Carrental::orderBy('rental_price');
        } elseif ($sort === 'most-expensive') {
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

        return view('pages.car-rental.index', compact('carrentals', 'carrentalcats', 'search', 'sort', 'destinationblogs'));
    }

    // Tour Package
    public function tourpackage(Request $request)
    {
        $tourpackages = Tourpackage::all();
        $tourpackagecats = Tourpackagecat::all();
        $tourroutes = Tourroute::all();
        $selectedTourroutes = $request->input('tourroutes', []);
        $search = $request->search;
        $sort = $request->sort;
        $category_slug = $request->category;
        $destinationblogs = Blog::with('blogcat')->whereHas('blogcat', function ($query) {
            $query->where('slug', 'destinasi');
        })->latest()->get();

        // Mulai query dengan mengutamakan kategori "lepas kunci"
        $tourpackages = Tourpackage::with('tourpackagecat')
            ->select('tourpackages.*')
            ->join('tourpackagecats', 'tourpackages.tourpackagecat_id', '=', 'tourpackagecats.id')
            ->orderByRaw("CASE WHEN tourpackagecats.slug = 'lepas-kunci' THEN 0 ELSE 1 END,
            tourpackages.price ASC");


        if ($sort === 'cheapest') {
            $tourpackages = Tourpackage::orderBy('price');
        } else if ($sort === 'most-expensive') {
            $tourpackages = Tourpackage::orderByDesc('price');
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
}
