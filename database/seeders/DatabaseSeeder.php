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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Blog::factory(10)->create();

        // User::factory()->create([
        //     'username' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::Create([
            'id' => 1,
            'name' => 'panoramaalam',
            'email' => 'admin@panoramaalam.id',
            'password' => 'panoramaalam2025',
        ]);
    }
}
