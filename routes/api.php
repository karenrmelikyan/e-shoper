<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\FilterController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function() {
    // products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'getProductDetails']);
    Route::post('/get-cart-products', [ProductController::class, 'getCartProducts']);

    // product filters
    Route::get('/filters', [FilterController::class, 'index']);
    Route::post('/filters', [FilterController::class, 'getFiltered']);

    // authorization
    Route::post('/register', [AuthController::class, 'registration']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/jwt-checking', [AuthController::class, 'jwtChecking']);

    // product's checkout order
    Route::post('/order-dispatch', [OrderController::class, 'orderDispatch']);
});

