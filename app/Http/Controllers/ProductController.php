<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, fn($q) =>
                $q->where('name', 'like', '%' . $request->search . '%')
            )
            ->when($request->category_id, fn($q) =>
                $q->where('category_id', $request->category_id)
            )
            ->paginate(10)
            ->withQueryString();

        return view('product.index', [
            'title'      => 'Daftar Produk',
            'products'   => $products,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create', [
        'title'      => 'Create Product',
        'units'      => ['pcs', 'kg', 'liter', 'box', 'lusin'],
        'categories' => Category::all(), // ← tambahkan ini
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Validasi data produk
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id', // ← tambahkan ini
        'name'        => 'required|max:255',
        'price'       => 'required|numeric',
        'stock'       => 'required|numeric',
        'description' => 'required',
        'unit'        => 'required',
    ], [
        'category_id.required' => 'Kategori tidak boleh kosong',
        'category_id.exists'   => 'Kategori tidak valid',
        'name.required'        => 'Nama Product tidak boleh kosong',
        'name.max'             => 'Nama Product tidak boleh lebih dari :max karakter',
        'price.required'       => 'Price Product tidak boleh kosong',
        'price.numeric'        => 'Price Product harus nomor',
        'stock.required'       => 'Stock Product tidak boleh kosong',
        'stock.numeric'        => 'Stock Product harus nomor',
        'description.required' => 'Description Product tidak boleh kosong',
        'unit.required'        => 'Unit Product tidak boleh kosong',
    ]); 

    Product::create($validated);

    return to_route('product.index')->with('success', 'Product berhasil ditambahkan!');;

}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', [
            'title'   => 'Detail Product',
            'product' => $product->load('category'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
        'title'      => 'Edit Product',
        'product'    => $product,
        'units'      => ['pcs', 'kg', 'liter', 'box', 'lusin'],
        'categories' => Category::all(), // ← tambahkan
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi data produk
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name'        => 'required|max:255',
        'price'       => 'required|numeric',
        'stock'       => 'required|numeric',
        'description' => 'required',
        'unit'        => 'required',
    ],[
        'category.id' => 'Category Harus Ada',
        'name.required' => 'Nama Product tidak boleh kosong',
        'name.max' => 'Nama Product tidak boleh lebih dari :max karakter',
        'price.required' => 'Price Product tidak boleh kosong',
        'price.numeric' => 'Price Product harus nomor',
        'stock.required' => 'Stock Product tidak boleh kosong',
        'stock.numeric' => 'Stock Product harus nomor',
        'description.required' => 'Description Product tidak boleh kosong',
        'unit.required' => 'Unit Product tidak boleh kosong',
    ]); 

    $product->update($validated);

    return to_route('product.index')->with('success', 'Product berhasil diubah!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete($product);

    return to_route('product.index')->with('success', 'Product berhasil dihapus!');

    }
}
