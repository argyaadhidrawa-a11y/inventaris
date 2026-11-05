@extends('layouts.app')
@section('title', 'Ubah Barang')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="bi bi-pencil-fill text-warning me-2"></i>Ubah Barang</h1>
            <p class="subtitle mb-0">Perbarui informasi barang</p>
        </div>
        <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('items.update', $item) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="name" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $item->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('category', $item->category) === $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                        <input id="stock" type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                            value="{{ old('stock', $item->stock) }}" min="0" required>
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                        <input id="price" type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', $item->price) }}" min="0" step="0.01" required>
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Perbarui</button>
                    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
