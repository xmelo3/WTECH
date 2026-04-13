<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('index'))->name('home');
Route::get('/store', fn () => view('store'))->name('store');
Route::get('/cart', fn () => view('cart'))->name('cart');
Route::get('/detail', fn () => view('detail'))->name('detail');
Route::get('/checkout', fn () => view('checkout'))->name('checkout');
Route::get('/payment', fn () => view('payment'))->name('payment');

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', fn () => view('profile'))->name('profile');
});

require __DIR__.'/auth.php';