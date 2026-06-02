<x-app>

    <x-slot:title>{{ $title }}</x-slot>

    <form method="POST" action="{{ route('product.update', $product) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Product name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name"
                value="{{ old('name', $product->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Product price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                name="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Product stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                name="stock" value="{{ old('stock', $product->stock) }}">
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Product description </label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" value="{{ old('description', $product->description) }}">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label">Product unit</label>
            <select class="form-select @error('unit') is-invalid @enderror" id="unit" name="unit">
                <option value="" disabled selected>-- Pilih Satuan --</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit }}" {{ old('unit', $product->unit) == $unit ? 'selected' : '' }}>
                        {{ $unit }}
                    </option>
                @endforeach
            </select>
            @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <a class="btn btn-primary" href="{{ route('product.index') }}" role="button">Cancel</a>
        <button type="submit" class="btn btn-warning">Submit</button>
    </form>
</x-app>
