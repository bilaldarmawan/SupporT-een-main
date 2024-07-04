@extends('user.layout.index')

@section('content')
@php
    use Darryldecode\Cart\Facades\CartFacade as Cart;
@endphp
<div class="container mt-5">
    <h2>Keranjang Belanja</h2>
    @if(Cart::getContent()->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach(Cart::getContent() as $item)
                    <tr>
                        <td><img src="{{ asset('images/' . $item->attributes->image) }}" width="50"></td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" name="qty" value="{{ $item->quantity }}" min="1">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <h4>Total: Rp {{ number_format(Cart::getTotal(), 2, ',', '.') }}</h4>
            <a href="{{ route('checkout.index') }}" class="btn btn-success">Checkout</a>
        </div>
    @else
        <p>Keranjang belanja kosong.</p>
    @endif
</div>
@endsection
