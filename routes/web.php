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

Route::group(["prefix" => "/admin"], function () {
    Route::get('/register', [AdminController::class, 'viewRegister'])->name('register');
    Route::post('/register', [AdminController::class, 'store'])->name('register');
    Route::get('/login', [AdminController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'viewDashboard'])->name('dashboard')->middleware('login');
    Route::get('/users', [AdminController::class, 'viewUsers'])->name('users')->middleware('login');
    Route::get('/profile/{id}', [AdminController::class, 'viewProfile'])->name('profile')->middleware('login');
    Route::get('/add-admin', [AdminController::class, 'viewAddAdmin'])->name('add')->middleware('login');
    Route::post('/add-admin', [AdminController::class, 'addAdmin'])->name('add')->middleware('login');
    Route::get('users/edit-user/{id}', [AdminController::class, 'viewUpdateAdmin'])->middleware('login');
    Route::post('users/edit-user/{id}', [AdminController::class, 'updateAdmin'])->middleware('login');
    Route::get('users/delete-user/{id}', [AdminController::class, 'destroy'])->middleware('login');

    Route::get('/getdata', [AdminController::class, 'getData']);

});


// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');
// Route::get('/users', function () {
//     return view('admin.users');
// })->name('users');
