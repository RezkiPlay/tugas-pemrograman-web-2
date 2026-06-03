<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', [ProductController::class, 'index']);

// Semua route CRUD otomatis terbuat
Route::resource('product', ProductController::class);
Route::resource('category', CategoryController::class);