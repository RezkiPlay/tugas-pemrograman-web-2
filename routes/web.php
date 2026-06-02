<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// Halaman utama (root) mengarah ke index
Route::get('/', [ProductController::class, 'index']);

// TAMPILKAN DATA (Read) - Menggunakan GET
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// TAMPILKAN FORM TAMBAH - Menggunakan GET
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');

// PROSES SIMPAN DATA (Create) - 🌟 WAJIB MENGGUNAKAN POST
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
