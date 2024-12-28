<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarRentalCategoryController;
use App\Http\Controllers\CarRentalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;


Route::middleware([SetLocale::class])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog-wisata', [HomeController::class, 'blogWisata'])->name('blog-wisata');
    Route::get('/paket-wisata', [HomeController::class, 'paketWisata'])->name('paket-wisata');
    Route::get('/sewa-mobil', [HomeController::class, 'sewaMobil'])->name('sewa-mobil');

    Route::resource('blogs', BlogController::class);
    Route::resource('sewas', CarRentalController::class);

    Route::get('/{user:username}/user-blogs', [HomeController::class, 'userBlogs'])->name('user.blogs');
    Route::get('/{blogCategory:name}/category-blogs', [HomeController::class, 'categoryBlogs'])->name('blog-category.blogs');

    Route::resource('/blog-categories', BlogCategoryController::class);
    Route::resource('/sewa-categories', CarRentalCategoryController::class);

    Route::middleware('guest')->group(function () {
        // Route::view('/basmalah', 'auth.register')->name('register');
        // Route::post('/basmalah', [AuthController::class, 'register']);

        Route::view('/hamdalah', 'auth.login')->name('login');
        Route::post('/hamdalah', [AuthController::class, 'login']);
    });

    Route::middleware('auth')->group(function () {
        Route::view('/basmalah', 'auth.register')->name('register');
        Route::post('/basmalah', [AuthController::class, 'register']);

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::view('/lauhah', 'dashboard.index')->name('dashboard');

        Route::get('/users', [DashboardController::class, 'users'])->name('users');
    });
});


Route::get('/set-locale/{locale}', function ($locale) {
    session(['locale' =>  $locale]);
    return back();
})->name('set-locale');

// Route::get('/debug-session', function () {
//     return session()->all();
// });
