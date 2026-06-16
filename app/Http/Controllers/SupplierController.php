<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::withCount('products')
            ->when($request->search, fn($q) =>
                $q->where('name', 'like', '%' . $request->search . '%')
            )
            ->paginate(10)
            ->withQueryString();

        return view('supplier.index', [
            'title'     => 'Daftar Supplier',
            'suppliers' => $suppliers,
        ]);
    }

    public function create()
    {
        return view('supplier.create', [
            'title' => 'Tambah Supplier',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'phone'   => 'required|max:20',
            'address' => 'required',
        ], [
            'name.required'    => 'Nama supplier tidak boleh kosong',
            'phone.required'   => 'Nomor telepon tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
        ]);

        Supplier::create($validated);
        return to_route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function show(Supplier $supplier)
    {
        return view('supplier.show', [
            'title'    => 'Detail Supplier',
            'supplier' => $supplier->load('products'),
        ]);
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', [
            'title'    => 'Edit Supplier',
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'phone'   => 'required|max:20',
            'address' => 'required',
        ], [
            'name.required'    => 'Nama supplier tidak boleh kosong',
            'phone.required'   => 'Nomor telepon tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
        ]);

        $supplier->update($validated);
        return to_route('supplier.index')->with('success', 'Supplier berhasil diupdate!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return to_route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}