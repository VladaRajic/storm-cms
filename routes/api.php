<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/products/{product}/comment', [ProductController::class, 'addComment']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'show']);
