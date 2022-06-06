<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/register', function () {
    return view('admin.Register.register');
})->name('register');
Route::get('/login', function () {
    return view('admin.Register.login');
})->name('login');
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');
Route::get('/users', function () {
    return view('admin.users');
})->name('users');

