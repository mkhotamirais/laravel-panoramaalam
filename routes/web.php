<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('blog-wisata', 'blog-wisata')->name('blog-wisata');
Route::view('paket-wisata', 'paket-wisata')->name('paket-wisata');
Route::view('sewa-mobil', 'sewa-mobil')->name('sewa-mobil');

Route::view('basmalah', 'auth.register')->name('register');
Route::view('hamdalah', 'auth.login')->name('login');

Route::view('lauhah', 'dashboard.index')->name('dashboard');
