@extends('admin.layout.index')

@section('title', 'Edit Produk')

@section('content')
<div class="container">
    <h1 class="mt-5 mb-4">Edit Produk</h1>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Produk</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.update', $product->product_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="nama_product" value="{{ $product->nama_product }}" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" value="{{ $product->harga }}" required>
                </div>
                <div class="form-group">
                    <label>Ukuran</label>
                    <input type="text" class="form-control" name="size" value="{{ $product->size }}" required>
                </div>
                <div class="form-group">
                    <label>Gambar Saat Ini</label><br>
                    <img src="{{ asset('images/' . $product->image) }}" width="200" class="mb-2">
                    <input type="file" class="form-control-file mt-2" name="image">
                </div>
                <div class="form-group">
                    <label>Tipe</label>
                    <input type="text" class="form-control" name="type" value="{{ $product->type }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
