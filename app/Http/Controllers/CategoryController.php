<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // ✅ Sudah ada, tambahkan search & pagination
    public function index(Request $request)
    {
        $categories = Category::query()
            ->when($request->search, fn($q) =>
                $q->where('name', 'like', '%' . $request->search . '%')
            )
            ->paginate(3)
            ->withQueryString();

        return view('category.index', [
            'title'      => 'Daftar Kategori',
            'categories' => $categories,
        ]);
    }

    // ✅ Tambahkan
    public function create()
    {
        return view('category.create', ['title' => 'Tambah Kategori']);
    }

    // ✅ Tambahkan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'slug'        => 'required|unique:categories|max:255',
            'description' => 'required',
        ],
        [
        'name.required'        => 'Nama kategori tidak boleh kosong',
        'slug.required'        => 'Slug tidak boleh kosong',
        'slug.unique'          => 'Slug sudah dipakai, gunakan yang lain',
        'description.required' => 'Deskripsi tidak boleh kosong',
    ]);

        Category::create($validated);
        return to_route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // ✅ Tambahkan
    public function show(Category $category)
    {
        return view('category.show', [
            'title'    => 'Detail Kategori',
            'category' => $category->load('products'),
        ]);
    }

    // ✅ Tambahkan
    public function edit(Category $category)
    {
        return view('category.edit', [
            'title'    => 'Edit Kategori',
            'category' => $category,
        ]);
    }

    // ✅ Tambahkan
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'slug'        => 'required|max:255|unique:categories,slug,' . $category->id,
            'description' => 'required',
        ]);

        $category->update($validated);
        return to_route('category.index')->with('success', 'Kategori berhasil diupdate!');
    }

    // ✅ Tambahkan
    public function destroy(Category $category)
    {
        $category->delete($category);
        return to_route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}