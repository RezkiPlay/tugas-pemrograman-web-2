<x-app>
    <x-slot:title>{{ $title }}</x-slot>

    @session('success')
        <div class="alert alert-success">{{ $value }}</div>
    @endsession

    <a class="btn btn-secondary mb-3" href="{{ route('product.index') }}">← Kembali ke Product</a>

    @if ($products->isEmpty())
        <div class="alert alert-info">Tidak ada data di trash.</div>
    @else
        <ul class="list-group">
            @foreach ($products as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        {{ $products->firstItem() + $loop->index }}.
                        {{ $product->name }}
                        @if ($product->brand)
                            <span class="badge bg-info">{{ $product->brand }}</span>
                        @endif
                        <span class="badge bg-secondary">{{ $product->category->name }}</span>
                        <small class="text-muted ms-2">
                            Dihapus: {{ $product->deleted_at->format('d M Y, H:i') }}
                        </small>
                    </span>
                    <div class="d-flex gap-1">
                        {{-- Restore --}}
                        <form action="{{ route('product.restore', $product->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Restore</button>
                        </form>

                        {{-- Force Delete --}}
                        <form action="{{ route('product.force-delete', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus permanen? Data tidak bisa dikembalikan!')">
                                Hapus Permanen
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">{{ $products->links() }}</div>
    @endif
</x-app>
