<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
Route::middleware(['auth', 'check.user.role'])->group(function() {
    Route::get('/', DashboardController::class)->name('main.index');
    Route::resource('category', CategoryController::class);
    Route::resource('color', ColorController::class);
    Route::resource('tag', TagController::class);
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
});

// Admin authentication
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::get('/add-sub', function (Request $request) {
    try {
        $data = $request->all();
        $data['category_id'] = 1;

        $sub = Subcategory::create($data);
        $sub->products()->attach([1, 2, 3]);

        return 'Product '. $sub->title . ' was added';

    } catch (Exception $e) {
        return $e->getMessage();
    }
});


Route::get('/delete-sub/{id}', function ($id) {
    try {
        $sub = Subcategory::findOrFail($id);
        $sub?->products()->detach();
        $sub?->delete();

        return 'Product '. $sub->title . ' was removed';

    } catch (Exception $e) {
        Log::error($e->getMessage());
    }
});
