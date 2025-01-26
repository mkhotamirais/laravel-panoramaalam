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
        $destinationblogs = Destinationblog::all();
        $blogs = Blog::latest();

        $search = $request->search;
        if ($search) {
            $blogs = $blogs->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $blogs->paginate(8);
        $blogcats = Blogcat::all();

        return view('pages.blog.index', compact('blogs', 'search', 'blogcats', 'destinationblogs'));
    }

    public function userBlogs(User $user, Request $request)
    {
        $userBlogs = $user->blogs()->latest();

        $search = $request->search;
        if ($search) {
            $userBlogs = $userBlogs->where('title', 'like', '%' . $request->search . '%');
        }

        $userBlogs = $userBlogs->paginate(8);

        return view('pages.blog.user-blog', compact('userBlogs', 'user', 'search'));
    }

    public function categoryBlogs(Blogcat $blogcat, Request $request)
    {
        $categoryBlogs = $blogcat->blogs();

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
        $destinationblogs = Destinationblog::all();
        $carrentals = Carrental::latest();
        $search = $request->search;

        if ($search) {
            $carrentals = $carrentals->where('brand_name', 'like', '%' . $request->search . '%');
        }

        $carrentals = $carrentals->paginate(8);
        $carrentalcats = Carrentalcat::all();

        return view('pages.car-rental.index', compact('carrentals', 'carrentalcats', 'search', 'destinationblogs'));
    }

    public function categoryCarrentals(Carrentalcat $carrentalcat, Request $request)
    {
        $categoryCarrentals = $carrentalcat->carrentals();

        $search = $request->search;
        if ($search) {
            $categoryCarrentalcats = $categoryCarrentals->where('title', 'like', '%' . $request->search . '%');
        }

        $categoryCarrentals = $categoryCarrentals->paginate(6);
        $carrentalcats = Carrentalcat::all();

        return view('pages.car-rental.cat-car-rental', compact('categoryCarrentals', 'carrentalcat', 'carrentalcats', 'search'));
    }

    // Tour Package
    public function tourpackage(Request $request)
    {
        $destinationblogs = Destinationblog::all();
        $selectedTourroutes = $request->input('tourroutes', []);

        $tourpackages = Tourpackage::when($selectedTourroutes, function ($query) use ($selectedTourroutes) {
            // Filter buku yang memiliki semua tourroute yang dipilih
            $query->whereHas('tourroutes', function ($query) use ($selectedTourroutes) {
                $query->whereIn('tourroutes.slug', $selectedTourroutes);
            }, '=', count($selectedTourroutes)); // Cek jumlah tourroute yang cocok harus sama dengan yang dipilih
        })->latest();


        $search = $request->search;
        if ($search) {
            $tourpackages = $tourpackages->where('name', 'like', '%' . $request->search . '%');
        }

        $tourpackages = $tourpackages->paginate(8);

        $tourpackagecats = Tourpackagecat::all();
        $tourroutes = Tourroute::all();

        return view('pages.tour-package.index', compact('tourpackages', 'tourpackagecats', 'search', 'tourroutes', 'selectedTourroutes', 'destinationblogs'));
    }

    public function categoryTourpackages(Tourpackagecat $tourpackagecat, Request $request)
    {
        $categoryTourpackages = $tourpackagecat->tourpackages();

        $search = $request->search;
        if ($search) {
            $categoryTourpackagecats = $categoryTourpackages->where('title', 'like', '%' . $request->search . '%');
        }

        $categoryTourpackages = $categoryTourpackages->paginate(8);
        $tourpackagecats = Tourpackagecat::all();

        return view('pages.tour-package.cat-tour-package', compact('categoryTourpackages', 'tourpackagecat', 'tourpackagecats', 'search'));
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
