<x-app>
    <x-slot:title>{{ $title }}</x-slot>

    @session('success')
        <div class="alert alert-success">{{ $value }}</div>
    @endsession

    <a class="btn btn-success mb-3" href="{{ route('supplier.create') }}">+ Create</a>

    <form method="GET" action="{{ route('supplier.index') }}" class="mb-3 d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Cari supplier..."
            value="{{ request('search') }}">
        <button class="btn btn-primary">Cari</button>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    <ul class="list-group">
        @foreach ($suppliers as $supplier)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    {{ $suppliers->firstItem() + $loop->index }}.
                    {{ $supplier->name }}
                    <span class="badge bg-primary">{{ $supplier->products_count }} Produk</span>
                </span>
                <div class="d-flex gap-1">
                    <a class="btn btn-info btn-sm" href="{{ route('supplier.show', $supplier) }}">Detail</a>
                    <a class="btn btn-warning btn-sm" href="{{ route('supplier.edit', $supplier) }}">Edit</a>
                    <form action="{{ route('supplier.destroy', $supplier) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Anda Yakin?')">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="mt-3">{{ $suppliers->links() }}</div>
</x-app>
