<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

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
        'categories' => Category::all(),
        'suppliers'  => Supplier::all(),
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'supplier_id' => 'required|exists:suppliers,id',
        'name'        => 'required|max:255',
        'brand'       => 'nullable|max:255',
        'price'       => 'required|numeric',
        'stock'       => 'required|numeric',
        'description' => 'required',
        'unit'        => 'required',
    ], [
        'category_id.required' => 'Kategori tidak boleh kosong',
        'supplier_id.required' => 'Supplier tidak boleh kosong',
        'name.required'        => 'Nama Product tidak boleh kosong',
        'name.max'             => 'Nama tidak boleh lebih dari :max karakter',
        'price.required'       => 'Harga tidak boleh kosong',
        'price.numeric'        => 'Harga harus berupa angka',
        'stock.required'       => 'Stok tidak boleh kosong',
        'stock.numeric'        => 'Stok harus berupa angka',
        'description.required' => 'Deskripsi tidak boleh kosong',
        'unit.required'        => 'Unit tidak boleh kosong',
    ]);

    DB::beginTransaction();
    try {
        Product::create($validated);
        DB::commit();
        return to_route('product.index')->with('success', 'Product berhasil ditambahkan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal menambahkan product: ' . $e->getMessage());
    }
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
        'categories' => Category::all(),
        'suppliers'  => Supplier::all(),
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'supplier_id' => 'required|exists:suppliers,id',
        'name'        => 'required|max:255',
        'brand'       => 'nullable|max:255',
        'price'       => 'required|numeric',
        'stock'       => 'required|numeric',
        'description' => 'required',
        'unit'        => 'required',
    ], [
        'category_id.required' => 'Kategori tidak boleh kosong',
        'supplier_id.required' => 'Supplier tidak boleh kosong',
        'name.required'        => 'Nama Product tidak boleh kosong',
        'name.max'             => 'Nama tidak boleh lebih dari :max karakter',
        'price.required'       => 'Harga tidak boleh kosong',
        'price.numeric'        => 'Harga harus berupa angka',
        'stock.required'       => 'Stok tidak boleh kosong',
        'stock.numeric'        => 'Stok harus berupa angka',
        'description.required' => 'Deskripsi tidak boleh kosong',
        'unit.required'        => 'Unit tidak boleh kosong',
    ]);

    DB::beginTransaction();
    try {
        $product->update($validated);
        DB::commit();
        return to_route('product.index')->with('success', 'Product berhasil diubah!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal mengubah product: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
{
    $product->delete($product);
    return to_route('product.index')->with('success', 'Product berhasil dihapus!');
}

// Commit 5 - Halaman Trash
public function trash()
{
    $products = Product::onlyTrashed()
        ->with(['category', 'supplier'])
        ->paginate(10);

    return view('product.trash', [
        'title'    => 'Trash Product',
        'products' => $products,
    ]);
}

// Commit 6 - Restore
public function restore($id)
{
    Product::onlyTrashed()->findOrFail($id)->restore();
    return to_route('product.trash')->with('success', 'Product berhasil direstore!');
}

// Commit 7 - Force Delete
public function forceDelete($id)
{
    Product::onlyTrashed()->findOrFail($id)->forceDelete();
    return to_route('product.trash')->with('success', 'Product berhasil dihapus permanen!');
}
}
