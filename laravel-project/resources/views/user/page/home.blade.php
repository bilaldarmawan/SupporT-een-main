@extends('user.layout.index')

@section('content')
<div class="row mt-5 no-gutters justify-content-center">
    <div class="col-10">
        <!-- Carousel Section -->
        <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/img/dahsboard/g1.jpg') }}" alt="First slide" height="450">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/img/dahsboard/g2.jpg') }}" alt="Second slide" height="450">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/img/dahsboard/g3.jpg') }}" alt="Third slide" height="450">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-10">
        <div class="card">
            <div class="card-body text-center">
                <h2>Tentang Kami</h2><br>
                <p>Selamat Datang di HomeClean, Silahkan Untuk Memesan layanan yang Anda Inginkan</p>
                <a href="{{ route('jasa.index') }}" class="btn btn-primary">Pesan</a>
            </div>
        </div>
    </div>
</div>
@endsection
