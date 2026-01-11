<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\ProductController;
Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('orders', OrderController::class);

    Route::get('activity-logs', [ActivityLogController::class, 'index']);
});


Route::middleware('auth:api')->group(function () {
    Route::apiResource('products', ProductController::class);
});


Route::middleware('auth:api')->get('/activity-logs', [ActivityLogController::class, 'index']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('customers', CustomerController::class);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
