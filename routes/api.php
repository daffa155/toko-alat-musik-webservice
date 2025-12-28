<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API OK'
    ]);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
