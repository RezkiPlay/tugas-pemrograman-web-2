<x-app>

    <x-slot:title>{{ $title }}</x-slot>

    @session('success')
        <div class="alert alert-success">
            {{ $value }}
        </div>
    @endsession

    <a class="btn btn-primary mb-3" href="{{ route('product.create') }}" role="button">Create</a>

    <ul class="list-group">
        @foreach ($products as $product)
            <li class="list-group-item">
                {{ $loop->iteration }}.{{ $product->name }}- Rp.{{ $product->price }}--{{ $product->stock }}
                <a class="btn btn-warning btn-sm " href="{{ route('product.edit', $product) }}" role="button">edit</a>
                <form action="{{ route('product.destroy', $product) }}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Anda Yakin?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <a class="btn btn-primary mb-3" href="{{ route('product.create') }}" role="button">Create</a>
</x-app>
