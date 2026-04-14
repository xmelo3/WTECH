<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StoreController;



Route::get('/payment/confirmation/{order}', [CheckoutController::class, 'confirmation'])
->name('payment.confirmation');
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/payment', [CheckoutController::class, 'payment'])->name('payment');
    Route::post('/payment', [CheckoutController::class, 'pay'])->name('payment.pay');
});
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
});
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');
});
Route::get('/store', [StoreController::class, 'index'])->name('store');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/', fn () => view('index'))->name('home');
Route::get('/detail', fn () => view('detail'))->name('detail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', fn () => view('profile'))->name('profile');
});

require __DIR__.'/auth.php';