<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    public function index()
{
        return view('product.index', [
            'title'    => 'Product',
            'products' => Product::all(),
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create', ['title' => 'Create Product',
        'units' => ['pcs', 'kg', 'liter', 'box', 'lusin'],]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi data produk
    $validated = $request->validate([
        'name'        => 'required|max:255',
        'price'       => 'required|numeric',
        'stock'       => 'required|numeric',
        'description' => 'required',
        'unit'        => 'required',
    ],[
        'name.required' => 'Nama Product tidak boleh kosong',
        'name.max' => 'Nama Product tidak boleh lebih dari :max karakter',
        'price.required' => 'Price Product tidak boleh kosong',
        'price.numeric' => 'Price Product harus nomor',
        'stock.required' => 'Stock Product tidak boleh kosong',
        'stock.numeric' => 'Stock Product harus nomor',
        'description.required' => 'Description Product tidak boleh kosong',
        'unit.required' => 'Unit Product tidak boleh kosong',
    ]); 

    Product::create($validated);

    return to_route('product.index')->with('success', 'Product berhasil ditambahkan!');;

}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
