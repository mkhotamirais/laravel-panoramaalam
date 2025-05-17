<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Blogcat;
use App\Models\Carrental;
use App\Models\Carrentalcat;
use App\Models\Tourpackage;
use App\Models\Tourpackagecat;
use App\Models\User;
use App\Models\Destinationblog;
use App\Models\Tourroute;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::Create([
            'id' => 1,
            'name' => 'panoramaalam',
            'email' => 'panoramaalamofficial@gmail.com',
            'email_verified_at' => now(),
            'password' => 'Bismillah2025!',
            // 'role' => 'admin',
            'remember_token' => null,
        ]);
    }
}
