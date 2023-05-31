<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Customer\CustomnerController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Order\OrderController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'Login']);
Route::middleware('auth:api')->group( function () {
    Route::prefix('customers')->group(function () {
        Route::get('show-customer', [AuthController::class, 'showCustomer']);
        Route::put('/update', [CustomnerController::class, 'update']);
    });
    Route::prefix('orders')->group(function () {
        Route::post('store', [OrderController::class, 'store']);
    });
});
Route::prefix('products')->group(function () {
    Route::get('index', [ProductController::class, 'index']);
    Route::get('getproduct/{id}', [ProductController::class, 'getDetailProduct']);
});
