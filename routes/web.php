<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog-wisata', [HomeController::class, 'blogWisata'])->name('blog-wisata');
Route::get('/paket-wisata', [HomeController::class, 'paketWisata'])->name('paket-wisata');
Route::get('/sewa-mobil', [HomeController::class, 'sewaMobil'])->name('sewa-mobil');

Route::resource('blogs', BlogController::class);
Route::get('/{user:username}/user-blogs', [HomeController::class, 'userBlogs'])->name('user.blogs');
Route::get('/{blogCategory:name}/category-blogs', [HomeController::class, 'categoryBlogs'])->name('blog-category.blogs');

Route::resource('/blog-categories', BlogCategoryController::class);

Route::middleware('guest')->group(function () {
    Route::view('/basmalah', 'auth.register')->name('register');
    Route::post('/basmalah', [AuthController::class, 'register']);

    Route::view('/hamdalah', 'auth.login')->name('login');
    Route::post('/hamdalah', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/lauhah', 'dashboard.index')->name('dashboard');
});
