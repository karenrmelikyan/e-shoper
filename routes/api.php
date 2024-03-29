<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\FilterController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\ProductController;
use App\Models\Category;
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

    // categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'getAllProductsOfCategory']);

    // products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'getProductDetails']);
    Route::post('/get-cart-products', [ProductController::class, 'getCartProducts']);
    Route::get('/products/category/{id}', [ProductController::class, 'getProductsByCategoryID']);
    Route::get('/products/title/{title}', [ProductController::class, 'searchProductsByTitle']);
    Route::get('/products/q/{q}', [ProductController::class, 'searchProductsByTitleAndDescription']);

    // product filtration
    Route::get('/filters', [FilterController::class, 'index']);
    Route::post('/filters', [FilterController::class, 'getFiltered']);

    // authorization
    Route::post('/register', [AuthController::class, 'registration']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/jwt-checking', [AuthController::class, 'jwtChecking']);

    // product's checkout order
    Route::post('/order-create', [OrderController::class, 'orderCreate']);
    Route::get('/stripe/success', [OrderController::class, 'paymentSuccess']);
    Route::get('/stripe/cancel', [OrderController::class, 'paymentCancel']);
});
