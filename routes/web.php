<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogcatController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarrentalcatController;
use App\Http\Controllers\CarrentalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TourpackagecatController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('home');
    Route::get('/car-rental', [PublicController::class, 'carRental'])->name('car-rental');
    Route::get('/tour-package', [PublicController::class, 'tourPackage'])->name('tour-package');
    Route::get('/blog', [PublicController::class, 'blog'])->name('blog');

    Route::get('/{user:username}/userblogs', [PublicController::class, 'userBlogs'])->name('user-blogs');
    Route::get('/{blogcat:slug}/categoryblogs', [PublicController::class, 'categoryBlogs'])->name('category-blogs');

    Route::resource('/blogs', BlogController::class);
    Route::resource('/carrentals', CarrentalController::class);

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

        Route::get('/lauhah', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
        Route::resource('/blogcats', BlogcatController::class);
        Route::resource('/carrentalcats', CarrentalcatController::class);
        Route::resource('/tourpackagecats', TourpackagecatController::class);
    });
});


Route::get('/set-locale/{locale}', function ($locale) {
    session(['locale' =>  $locale]);
    return back();
})->name('set-locale');

// Route::get('/debug-session', function () {
//     return session()->all();
// });
