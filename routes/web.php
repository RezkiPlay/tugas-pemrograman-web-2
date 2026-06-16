<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', [ProductController::class, 'index']);

// Semua route CRUD otomatis terbuat
Route::resource('product', ProductController::class);
Route::resource('category', CategoryController::class);
Route::resource('supplier', SupplierController::class);