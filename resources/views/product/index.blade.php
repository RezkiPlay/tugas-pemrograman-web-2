<x-app>
    <x-slot:title>{{ $title }}</x-slot>

    @session('success')
        <div class="alert alert-success">{{ $value }}</div>
    @endsession

    <a class="btn btn-success mb-3" href="{{ route('product.create') }}" role="button">+ Create</a>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('product.index') }}" class="mb-3 d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Cari produk..."
            value="{{ request('search') }}">

        <select name="category_id" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary">Cari</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    <ul class="list-group">
        @foreach ($products as $product)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    {{ $products->firstItem() + $loop->index }}.
                    {{ $product->name }}
                    <span class="badge bg-secondary">{{ $product->category->name }}</span>
                    - Rp{{ number_format($product->price) }}
                    - Stok: {{ $product->stock }}
                </span>
                <div class="d-flex gap-1">
                    <a class="btn btn-info btn-sm" href="{{ route('product.show', $product) }}">Detail</a>
                    <a class="btn btn-warning btn-sm" href="{{ route('product.edit', $product) }}">Edit</a>
                    <form action="{{ route('product.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Anda Yakin?')">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $products->links() }}
    </div>
</x-app>
