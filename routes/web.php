<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);

// ← Wajib di atas Route::resource
Route::get('/product/trash', [ProductController::class, 'trash'])->name('product.trash');
Route::patch('/product/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
Route::delete('/product/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('product.force-delete');

Route::resource('product', ProductController::class);
Route::resource('category', CategoryController::class);
Route::resource('supplier', SupplierController::class);