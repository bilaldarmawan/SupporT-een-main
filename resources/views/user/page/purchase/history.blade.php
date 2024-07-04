@extends('user.layout.index')

@section('content')
<div class="container mt-5">
    <h2>Riwayat Pembelian</h2>

    @if($transactions->count() > 0)
        @foreach($transactions as $transaction)
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Transaksi #{{ $transaction->id }}</h3>
                </div>
                <div class="card-body">
                    <p>Nama: {{ $transaction->nama }}</p>
                    <p>Alamat: {{ $transaction->alamat }}</p>
                    <p>No HP: {{ $transaction->no_hp }}</p>
                    <p>Total: Rp {{ number_format($transaction->total, 2, ',', '.') }}</p>
                    <p>Status: 
                        @if ($transaction->status === 'pending')
                            Belum Diterima
                        @elseif ($transaction->status === 'received')
                            Pesanan Diterima
                        @else
                            {{ $transaction->status }}
                        @endif
                    </p>

                    <h4>Detail Pembelian</h4>
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
            </div>
        @endforeach
    @else
        <p>Tidak ada riwayat pembelian.</p>
    @endif
</div>
@endsection
