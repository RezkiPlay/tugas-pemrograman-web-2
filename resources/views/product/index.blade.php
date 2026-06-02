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
            </li>
        @endforeach
    </ul>

    <a class="btn btn-primary mb-3" href="{{ route('product.create') }}" role="button">Create</a>
</x-app>
