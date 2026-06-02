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
Route::post('/product', [ProductController::class, 'store'])->name('product.store');