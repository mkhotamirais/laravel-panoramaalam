<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Carrental;
use App\Models\Tourpackage;
use App\Models\User;

class DashController extends Controller
{

    public function index()
    {
        $links = [
            'blog' => [
                ['href' => 'blog', 'label' => 'Blog List'],
                ['href' => 'blogcats.index', 'label' => 'Blog Categories'],
            ],
            'carrental' => [
                ['href' => 'rental-mobil', 'label' => 'Car Rental List'],
                ['href' => 'carrentalcats.index', 'label' => 'Car Rental Categories'],
            ],
            'tourpackage' => [
                ['href' => 'paket-wisata', 'label' => 'Tour Package List'],
                ['href' => 'tourpackagecats.index', 'label' => 'Tour Package Categories'],
                ['href' => 'tourroutes.index', 'label' => 'Tour Package Routes'],
            ],
        ];

        $blogs = Blog::all();
        $destinationblogs = [];
        $carrentals = Carrental::all();
        $tourpackages = Tourpackage::all();

        return view('dashboard.index', compact('links', 'blogs', 'destinationblogs', 'carrentals', 'tourpackages'));
    }
}
