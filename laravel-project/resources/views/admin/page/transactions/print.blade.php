<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Transaksi #{{ $transaction->id }}</title>
    <style>
        /* CSS styling untuk halaman cetak */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .transaction-details {
            margin-bottom: 30px;
        }
        .transaction-details h2 {
            margin-bottom: 10px;
        }
        /* tambahkan styling tambahan sesuai kebutuhan */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detail Transaksi #{{ $transaction->id }}</h1>
        </div>
        
        <div class="transaction-details">
            <h2>Informasi Pengguna</h2>
            <p>Nama: {{ $transaction->nama }}</p>
            <p>Alamat: {{ $transaction->alamat }}</p>
            <p>No HP: {{ $transaction->no_hp }}</p>
        </div>
        
        <div class="transaction-details">
            <h2>Detail Pembelian</h2>
            <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
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
        </div>
        
        <div class="footer" style="text-align: center; margin-top: 30px;">
            <p>&copy; {{ date('Y') }} Your Company</p>
        </div>
    </div>
</body>
</html>
