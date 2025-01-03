<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Carrental;
use App\Models\Tourpackage;
use App\Models\User;
use Illuminate\Http\Request;

class DashController extends Controller
{

    public function index()
    {
        // <p class="font-semibold mt-3">Users</p>
        // <a href="{{ route('users') }}">User List</a>
        // <p class="font-semibold mt-3">Blogs</p>
        // <a href="{{ route('blogs.index') }}">Blog List</a>
        // <a href="{{ route('blogcats.index') }}">Blog Categories</a>
        // <p class="font-semibold mt-3">Car Rentals</p>
        // <a href="{{ route('carrentals.index') }}">Car Rental List</a>
        // <a href="{{ route('carrentalcats.index') }}">Car Rental Categories</a>
        // <p class="font-semibold mt-3">Tour Packages</p>
        // <a href="{{ route('tourpackages.index') }}">Tour Package List</a>
        // <a href="{{ route('tourpackagecats.index') }}">Tour Package Categories</a>
        $blogLinks = [
            ['href' => 'blogs.index', 'label' => 'Blog List'],
            ['href' => 'blogcats.index', 'label' => 'Blog Categories'],
        ];

        $carrentalLinks = [
            ['href' => 'carrentals.index', 'label' => 'Car Rental List'],
            ['href' => 'carrentalcats.index', 'label' => 'Car Rental Categories'],
        ];

        $tourpackageLinks = [
            ['href' => 'tourpackages.index', 'label' => 'Tour Package List'],
            ['href' => 'tourpackagecats.index', 'label' => 'Tour Package Categories'],
        ];

        $blogs = Blog::all();
        $carrentals = Carrental::all();
        $tourpackages = Tourpackage::all();

        return view('dashboard.index', compact('blogLinks', 'carrentalLinks', 'tourpackageLinks', 'blogs', 'carrentals', 'tourpackages'));
    }
    public function users()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }
}
