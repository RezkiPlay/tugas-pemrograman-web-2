<x-app>

    <x-slot:title>{{ $title }}</x-slot>

    <ul class="list-group">
        @foreach ($products as $product)
            <li class="list-group-item">{{ $loop->iteration }}.{{ $product->name }}
                --{{ $product->price }}--{{ $product->stock }}</li>
        @endforeach
    </ul>
</x-app>
