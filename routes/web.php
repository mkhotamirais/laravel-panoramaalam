<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogcatController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarrentalcatController;
use App\Http\Controllers\CarrentalController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TourpackagecatController;
use App\Http\Controllers\TourpackageController;
use App\Http\Controllers\TourrouteController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('home');

    Route::middleware('guest')->group(function () {
        Route::view('/login', 'auth.login')->name('login');
        Route::post('/login', [AuthController::class, 'login']);

        // Forgot Password
        Route::get('/forgot-password', [ResetPasswordController::class, 'request'])->name('password.request');
        Route::post('/forgot-password', [ResetPasswordController::class, 'email'])->name('password.email');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'update'])->name('password.update');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashController::class, 'index'])->name('dashboard');

        Route::resource('blog', BlogController::class)->except(['show', 'index']);
        Route::resource('rental-mobil', CarrentalController::class)
            ->parameters([
                'rental-mobil' => 'carrental',
            ])
            ->except(['show', 'index']);;
        Route::resource('paket-wisata', TourpackageController::class)
            ->parameters([
                'paket-wisata' => 'tourpackage',
            ])
            ->except(['show', 'index']);

        Route::resource('blogcats', BlogcatController::class);
        Route::resource('carrentalcats', CarrentalcatController::class);
        Route::resource('tourpackagecats', TourpackagecatController::class);
        Route::resource('tourroutes', TourrouteController::class);
    });

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

    Route::get('/rental-mobil', [CarrentalController::class, 'index'])->name('rental-mobil');
    Route::get('/rental-mobil/{carrental}', [CarrentalController::class, 'show'])->name('rental-mobil.show');

    Route::get('/paket-wisata', [TourpackageController::class, 'index'])->name('paket-wisata');
    Route::get('/paket-wisata/{tourpackage}', [TourpackageController::class, 'show'])->name('paket-wisata.show');
});


Route::get('/set-locale/{locale}', function ($locale) {
    session(['locale' =>  $locale]);
    return back();
})->name('set-locale');

// Route::get('/debug-session', function () {
//     return session()->all();
// });
