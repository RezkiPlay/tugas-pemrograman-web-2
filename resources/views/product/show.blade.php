<x-app>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">{{ $product->name }}</h4>

            <table class="table table-bordered mt-3">
                <tr>
                    <th width="200">Kategori</th>
                    <td>{{ $product->category->name }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp{{ number_format($product->price) }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>{{ $product->stock }} {{ $product->unit }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th>Ditambahkan</th>
                    <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diubah</th>
                    <td>{{ $product->updated_at->format('d M Y, H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a class="btn btn-secondary" href="{{ route('product.index') }}">Kembali</a>
        <a class="btn btn-warning" href="{{ route('product.edit', $product) }}">Edit</a>
        <form action="{{ route('product.destroy', $product) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin?')">Delete</button>
        </form>
    </div>
</x-app>
