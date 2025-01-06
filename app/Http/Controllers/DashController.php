<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Carrental;
use App\Models\Destinationblog;
use App\Models\Tourpackage;
use App\Models\User;
use Illuminate\Http\Request;

class DashController extends Controller
{

    public function index()
    {
        $links = [
            'blog' => [
                ['href' => 'blogs.index', 'label' => 'Blog List'],
                ['href' => 'blogcats.index', 'label' => 'Blog Categories'],
            ],
            'destinationblog' => [
                ['href' => 'destinationblogs.index', 'label' => 'Destination Blog Lists'],
            ],
            'carrental' => [
                ['href' => 'carrentals.index', 'label' => 'Car Rental List'],
                ['href' => 'carrentalcats.index', 'label' => 'Car Rental Categories'],
            ],
            'tourpackage' => [
                ['href' => 'tourpackages.index', 'label' => 'Tour Package List'],
                ['href' => 'tourpackagecats.index', 'label' => 'Tour Package Categories'],
                ['href' => 'tourroutes.index', 'label' => 'Tour Package Routes'],
            ],
        ];

        $blogs = Blog::all();
        $destinationblogs = Destinationblog::all();
        $carrentals = Carrental::all();
        $tourpackages = Tourpackage::all();

        return view('dashboard.index', compact('links', 'blogs', 'destinationblogs', 'carrentals', 'tourpackages'));
    }
    public function users()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }
}
