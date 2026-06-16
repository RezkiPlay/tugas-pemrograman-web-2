<x-app>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">{{ $supplier->name }}</h4>
            <table class="table table-bordered mt-3">
                <tr>
                    <th width="200">No. Telepon</th>
                    <td>{{ $supplier->phone }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $supplier->address }}</td>
                </tr>
                <tr>
                    <th>Jumlah Produk</th>
                    <td>{{ $supplier->products->count() }} Produk</td>
                </tr>
            </table>
        </div>
    </div>

    <h5>Daftar Produk</h5>
    @if ($supplier->products->isEmpty())
        <div class="alert alert-warning">Belum ada produk dari supplier ini.</div>
    @else
        <ul class="list-group">
            @foreach ($supplier->products as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $loop->iteration }}. {{ $product->name }}</span>
                    <span class="badge bg-primary">Rp{{ number_format($product->price) }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-3 d-flex gap-2">
        <a class="btn btn-secondary" href="{{ route('supplier.index') }}">Kembali</a>
        <a class="btn btn-warning" href="{{ route('supplier.edit', $supplier) }}">Edit</a>
        <form action="{{ route('supplier.destroy', $supplier) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin?')">Delete</button>
        </form>
    </div>
</x-app>
