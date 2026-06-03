<x-app>
    <x-slot:title>{{ $title }}</x-slot>

    @session('success')
        <div class="alert alert-success">{{ $value }}</div>
    @endsession

    <a class="btn btn-success mb-3" href="{{ route('category.create') }}" role="button">+ Create</a>

    <form method="GET" action="{{ route('category.index') }}" class="mb-3 d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Cari kategori..."
            value="{{ request('search') }}">
        <button class="btn btn-primary">Cari</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    <ul class="list-group">
        @foreach ($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    {{-- ✅ Nomor urut tidak reset tiap halaman --}}
                    {{ $categories->firstItem() + $loop->index }}.
                    {{ $category->name }} - {{ $category->slug }}
                </span>
                <div class="d-flex gap-1">
                    <a class="btn btn-info btn-sm" href="{{ route('category.show', $category) }}">Detail</a>
                    <a class="btn btn-warning btn-sm" href="{{ route('category.edit', $category) }}">Edit</a>
                    <form action="{{ route('category.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Anda Yakin?')">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>
</x-app>
