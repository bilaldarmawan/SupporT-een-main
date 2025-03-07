@extends('admin.layout.index')

@section('title', 'Tambah Produk')

@section('content')
<div class="container">
    <h1 class="mt-5 mb-4">Tambah Produk</h1>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Produk</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="nama_product" placeholder="Nama Produk" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga" placeholder="Harga" required>
                </div>
                <div class="form-group">
                    <label>Ukuran</label>
                    <input type="text" class="form-control" name="size" placeholder="Ukuran" required>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control-file" name="image" required>
                </div>
                <div class="form-group">
                    <label>Tipe</label>
                    <input type="text" class="form-control" name="type" placeholder="Tipe" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
