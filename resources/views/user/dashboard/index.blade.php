@section('content')

<div class="hero-section">
    <img src="{{ asset('assets/img/dashboard.jpg') }}" class="card-img-top" alt="Gambar Service">
    <div class="content">
        <h1>Selamat Datang di Home Clean</h1>
        <p>Kami menyediakan layanan kebersihan terbaik untuk rumah Anda.</p>
        <a href="/login" class="btn btn-primary">Masuk</a>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card p-4" style="background-color: #f5f5f5; border: none; border-radius: 10px;">
                <h2>Kenapa OKHOME?</h2>
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
                        <p class="card-text">Layanan ini untuk mengerjakan tugas-tugas rumah tangga untuk Anda, dan berbagai pekerjaan rumah tangga lainnya, minimal order 2 jam. Mulai dari Rp 80,000 / 2 jam.</p>
                        <a href="#" class="card-link">Lihat rincian</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #ffebee;">
                    <div class="card-body">
                        <h5 class="card-title">Deep Cleaning</h5>
                        <p class="card-text">Manjakan diri dalam mewahnya kebersihan dengan Layanan Kebersihan Profesional kami, mulai dari Rp 120,000 / 2 jam.</p>
                        <a href="#" class="card-link">Lihat rincian</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #fce4ec;">
                    <div class="card-body">
                        <h5 class="card-title">Perawatan AC</h5>
                        <p class="card-text">Pembersihan dan perawatan AC, menghilangkan debu dan sumbatan, memperbaiki AC rusak agar sejuk dan lancar. Mulai dari Rp 75,000 per visit.</p>
                        <a href="#" class="card-link">Lihat rincian</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #e1f5fe;">
                    <div class="card-body">
                        <h5 class="card-title">Hydrocleaning</h5>
                        <p class="card-text">Metode pembersihan bertekanan tinggi yang memanfaatkan air untuk menghilangkan berbagai jenis kontaminan, kotoran, dan penumpukan dari area permukaan barang Anda. Mulai dari Rp 275,000.</p>
                        <a href="#" class="card-link">Lihat rincian</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #fff8e1;">
                    <div class="card-body">
                        <h5 class="card-title">Layanan untuk Kantor, Kafe, & Kost</h5>
                        <p class="card-text">Hubungi kami untuk pertanyaan bisnis. Tim kami siap mengubah ruangan Anda. Jadwalkan survei dan biarkan kami menghadirkan keunggulan bagi lingkungan rumah Anda.</p>
                        <a href="#" class="card-link">Lihat rincian</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-3" style="background-color: #fff3e0;">
                    <div class="card-body">
                        <h5 class="card-title">Jasa Kebersihan Halaman</h5>
                        <p class="card-text">Kami menawarkan layanan kebersihan halaman yang memastikan halaman Anda tetap bersih dan terawat. Mulai dari Rp 150,000 per visit.</p>
                        <a href="#" class="card-link">Lihat rincian</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
