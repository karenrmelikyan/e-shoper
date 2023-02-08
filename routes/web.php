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

// Admin routes
Route::get('/', \App\Http\Controllers\Admin\DashboardController::class)->name('main.index');
Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('tag', \App\Http\Controllers\Admin\TagController::class);
Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
