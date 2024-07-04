@extends('admin.layout.index')

@section('content')
<div class="container mt-5">
    <h2>Riwayat Transaksi</h2>

    @if($transactions->count() > 0)
        @foreach($transactions as $transaction)
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Transaksi #{{ $transaction->id }}</h3>
                    <a href="{{ route('admin.page.transactions.print', $transaction->id) }}" class="btn btn-secondary btn-sm float-right" target="_blank">Print</a>
                </div>
                <div class="card-body">
                    <p>Nama: {{ $transaction->nama }}</p>
                    <p>Alamat: {{ $transaction->alamat }}</p>
                    <p>No HP: {{ $transaction->no_hp }}</p>
                    <p>Total: Rp {{ number_format($transaction->total, 2, ',', '.') }}</p>
                    <p>Status: 
                        @if ($transaction->status === 'pending')
                            Belum Diterima
                        @elseif ($transaction->status === 'accepted')
                            Pesanan Diterima
                        @elseif ($transaction->status === 'rejected')
                            Pesanan Ditolak
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
                                    <td>{{ $detail->product->nama_product }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>Rp {{ number_format($detail->price, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($detail->price * $detail->quantity, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form action="{{ route('admin.page.transactions.updateStatus', $transaction->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="status">Ubah Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="accepted" {{ $transaction->status === 'accepted' ? 'selected' : '' }}>Pesanan Diterima</option>
                                <option value="rejected" {{ $transaction->status === 'rejected' ? 'selected' : '' }}>Pesanan Ditolak</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p>Tidak ada riwayat transaksi.</p>
    @endif
</div>
@endsection
