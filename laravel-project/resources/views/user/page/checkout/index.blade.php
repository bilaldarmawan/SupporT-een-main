@extends('user.layout.index')

@section('content')
<div class="container mt-5">
    <h2>{{ $title }}</h2>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="no_hp">Nomor HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
    </form>
</div>
@endsection
