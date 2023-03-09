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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function() {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'getProductDetails']);
    Route::post('/get-cart-products', [ProductController::class, 'getCartProducts']);

    Route::get('/filters', [FilterController::class, 'index']);
    Route::post('/filters', [FilterController::class, 'getFiltered']);

    Route::post('/register', [AuthController::class, 'registration']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/jwt-checking', [AuthController::class, 'jwtChecking']);

    Route::post('/order-dispatch', [OrderController::class, 'orderDispatch']);
});


