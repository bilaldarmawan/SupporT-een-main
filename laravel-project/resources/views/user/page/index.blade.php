@extends('user.layout.dashboard')

@section('content')

<div class="hero-section">
    <img src="{{ asset('assets/img/dashboard.jpg') }}" class="card-img-top" alt="Gambar Service">
    <div class="content">
        <h1>Selamat Datang di Home Clean</h1>
        <p>Kami menyediakan layanan kebersihan terbaik untuk rumah Anda.</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Masuk</button>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar</button>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-container">
                <h2>Kenapa Home Clean?</h2>
                <p>Layanan sepenuhnya dijamin dengan asuransi kerusakan yang sah.</p>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-dark"></i> Kebijakan kehilangan & kerusakan barang
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-dark"></i> Jaminan kualitas penuh
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-dark"></i> Petugas profesional & alat kebersihan lengkap
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="font-weight-bold">Layanan Kami</h2>
    <div class="card p-4" style="background-color: #f5f5f5; border: none; border-radius: 10px;">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #e3f2fd;">
                    <div class="card-body">
                        <h5 class="card-title">ART Harian</h5>
                        <p class="card-text">Layanan ini untuk mengerjakan tugas-tugas rumah tangga untuk Anda, dan berbagai pekerjaan rumah tangga lainnya.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #ffebee;">
                    <div class="card-body">
                        <h5 class="card-title">Deep Cleaning</h5>
                        <p class="card-text">Manjakan diri dalam mewahnya kebersihan dengan Layanan Kebersihan Profesional kami.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #fce4ec;">
                    <div class="card-body">
                        <h5 class="card-title">Perawatan AC</h5>
                        <p class="card-text">Pembersihan dan perawatan AC, menghilangkan debu dan sumbatan, memperbaiki AC rusak agar sejuk dan lancar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #e1f5fe;">
                    <div class="card-body">
                        <h5 class="card-title">Hydrocleaning</h5>
                        <p class="card-text">Metode pembersihan bertekanan tinggi yang memanfaatkan air untuk menghilangkan berbagai jenis kontaminan, kotoran, dan penumpukan dari area permukaan barang Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #fff8e1;">
                    <div class="card-body">
                        <h5 class="card-title">Layanan untuk Kantor, Kafe, & Kost</h5>
                        <p class="card-text">Hubungi kami untuk pertanyaan bisnis. Tim kami siap mengubah ruangan Anda. Jadwalkan survei dan biarkan kami menghadirkan keunggulan bagi lingkungan rumah Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #fff3e0;">
                    <div class="card-body">
                        <h5 class="card-title">Jasa Kebersihan Halaman</h5>
                        <p class="card-text">Kami menawarkan layanan kebersihan halaman yang memastikan halaman Anda tetap bersih dan terawat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">Register</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Login</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="false">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="true">Register</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Login</button>
                        </form>
                    </div>
                    <div class="tab-pane fade show active" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
