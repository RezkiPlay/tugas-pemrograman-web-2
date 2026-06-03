<x-app>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">{{ $category->name }}</h4>
            <p class="card-text text-muted">Slug: {{ $category->slug }}</p>
            <p class="card-text">{{ $category->description }}</p>
        </div>
    </div>

    <h5>Daftar Produk ({{ $category->products->count() }})</h5>

    @if ($category->products->isEmpty())
        <div class="alert alert-warning">Belum ada produk di kategori ini.</div>
    @else
        <ul class="list-group">
            @foreach ($category->products as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $loop->iteration }}. {{ $product->name }} - Rp{{ number_format($product->price) }}</span>
                    <span class="badge bg-primary">{{ $product->unit }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-3 d-flex gap-2">
        <a class="btn btn-secondary" href="{{ route('category.index') }}">Kembali</a>
        <a class="btn btn-warning" href="{{ route('category.edit', $category) }}">Edit</a>
    </div>
</x-app>
