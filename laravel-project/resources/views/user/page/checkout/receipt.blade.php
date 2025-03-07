@extends('user.layout.index')

@section('content')
<div class="container mt-5">
    <h2>Resi Pembelian</h2>

    <div class="card">
        <div class="card-header">
            <h3>Transaksi #{{ $transaction->id }}</h3>
        </div>
        <div class="card-body">
            <p>Nama: {{ $transaction->nama }}</p>
            <p>Alamat: {{ $transaction->alamat }}</p>
            <p>No HP: {{ $transaction->no_hp }}</p>
            <p>Total: Rp {{ number_format($transaction->total, 2, ',', '.') }}</p>
            <p>Status: {{ $transaction->status }}</p>
        </div>
    </div>

    <h3>Detail Pembelian</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp {{ number_format($detail->price, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->price * $detail->quantity, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
