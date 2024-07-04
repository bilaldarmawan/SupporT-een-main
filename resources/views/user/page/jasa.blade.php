@extends('user.layout.index')

@section('content')

<div class="container mt-5">
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="Gambar Produk">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama_product }}</h5>
                        <p class="card-text">{{ $product->size }}</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="m-0" style="font-size: 16px; font-weight: 600;">Rp {{ number_format($product->harga, 2, ',', '.') }}</p>
                            <form action="{{ route('cart.add', ['id' => $product->product_id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
