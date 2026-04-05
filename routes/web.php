<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::view('/', 'index')->name('home');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::view('/store', 'store')->name('store');
Route::view('/cart', 'cart')->name('cart');
Route::view('/profile', 'profile')->name('profile');