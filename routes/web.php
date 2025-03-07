<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogcatController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarrentalcatController;
use App\Http\Controllers\CarrentalController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TourpackagecatController;
use App\Http\Controllers\TourpackageController;
use App\Http\Controllers\TourrouteController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('home');
    Route::get('/car-rental', [PublicController::class, 'carrental'])->name('car-rental');
    Route::get('/tour-package', [PublicController::class, 'tourpackage'])->name('tour-package');
    Route::get('/blog', [PublicController::class, 'blog'])->name('blog');

    Route::middleware('guest')->group(function () {
        Route::view('/login', 'dashboard.login')->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::resource('/blogs', BlogController::class);
    Route::resource('/carrentals', CarrentalController::class);
    Route::resource('/tourpackages', TourpackageController::class);

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashController::class, 'index'])->name('dashboard');

        Route::resource('/blogcats', BlogcatController::class);
        Route::resource('/carrentalcats', CarrentalcatController::class);
        Route::resource('/tourpackagecats', TourpackagecatController::class);
        Route::resource('/tourroutes', TourrouteController::class);
    });
});


Route::get('/set-locale/{locale}', function ($locale) {
    session(['locale' =>  $locale]);
    return back();
})->name('set-locale');

// Route::get('/debug-session', function () {
//     return session()->all();
// });
