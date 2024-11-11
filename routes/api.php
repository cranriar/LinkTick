<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\GetProductController;
use App\Http\Controllers\Product\ListProductController;
use App\Http\Controllers\Product\UpdateProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//route user
Route::post('user', CreateUserController::class);

//route product

Route::post('product', CreateProductController::class);
Route::get('product', GetProductController::class);
Route::put('product', UpdateProductController::class);
Route::get('productList', ListProductController::class);
