<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
Route::group(["prefix" => "/admin"], function(){
    Route::get('/register', [AdminController::class, 'viewRegister'])->name('register');
    Route::post('/register', [AdminController::class, 'store'])->name('register');
    Route::get('/login', [AdminController::class, 'viewLogin'])->name('login');
    Route::get('/dashboard', [AdminController::class, 'viewDashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'viewUsers'])->name('users');


});


// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');
// Route::get('/users', function () {
//     return view('admin.users');
// })->name('users');

