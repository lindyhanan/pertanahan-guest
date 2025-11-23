@extends('layouts.guest.app')

@section('content')
    <section class="hero position-relative"
        style="background: url('{{ asset('assets/img/contoh2.jpg') }}') center/cover no-repeat; height: 80vh;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.55);"></div>
        <div
            class="container h-100 d-flex flex-column justify-content-center align-items-center text-center text-white position-relative">
            <h1 class="fw-bold display-4 animate__animated animate__fadeInDown">Selamat Datang di Sistem Pertanahan</h1>
            <p class="lead mt-3 mb-4 animate__animated animate__fadeInUp" style="max-width: 700px;">
                Kelola data warga, jenis penggunaan tanah, dan informasi pertanahan dengan mudah dan cepat.
            </p>
            <div>
                <a href="{{ route('warga.create') }}"
                    class="btn text-white px-4 py-2 me-2 rounded-pill shadow-sm animate__animated animate__fadeInUp animate__delay-1s"
                    style="background-color:#2e7d32;">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Warga
                </a>
                <a href="{{ route('penggunaan.index') }}"
                    class="btn btn-outline-light px-4 py-2 rounded-pill shadow-sm animate__animated animate__fadeInUp animate__delay-1s">
                    <i class="fas fa-database me-1"></i> Lihat Data
                </a>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color:#f8faf8;">
        <div class="container">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background-color:#ffffff;">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success">Statistik Aplikasi</h2>
                    <p class="text-muted">Ringkasan informasi dari sistem pertanahan</p>
                </div>
                <div class="row justify-content-center g-4">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm text-center py-4 rounded-4 h-100">
                            <div class="text-success fs-1 mb-2">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 class="fw-bold mb-1">Warga Terdaftar</h5>
                            <p class="text-muted mb-0 fs-5">1,294</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm text-center py-4 rounded-4 h-100">
                            <div class="text-success fs-1 mb-2">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <h5 class="fw-bold mb-1">Jenis Penggunaan</h5>
                            <p class="text-muted mb-0 fs-5">25</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm text-center py-4 rounded-4 h-100">
                            <div class="text-success fs-1 mb-2">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h5 class="fw-bold mb-1">User Aktif</h5>
                            <p class="text-muted mb-0 fs-5">5</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background-color:#ffffff;">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success">Layanan Utama</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center">
                                <div class="text-success fs-2 mb-3">
                                    <i class="fas fa-home"></i>
                                </div>
                                <h5 class="fw-bold">Pendataan Warga</h5>
                                <p class="text-muted">Mengelola data warga dengan sistem yang mudah dan efisien.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center">
                                <div class="text-success fs-2 mb-3">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <h5 class="fw-bold">Penggunaan Tanah</h5>
                                <p class="text-muted">Melacak jenis penggunaan tanah untuk keperluan administrasi.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body text-center">
                                <div class="text-success fs-2 mb-3">
                                    <i class="fas fa-user-cog"></i>
                                </div>
                                <h5 class="fw-bold">Manajemen User</h5>
                                <p class="text-muted">Kelola pengguna yang memiliki akses ke sistem dengan mudah.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-dark mb-4">Tentang Aplikasi</h2>
                    <p class="text-muted mb-5">
                        Aplikasi Pertanahan ini dirancang untuk mendukung administrasi dan transparansi data pertanahan
                        dengan antarmuka yang modern, ringan, dan mudah digunakan oleh pengguna.
                    </p>

                    <div class="row justify-content-center g-4">
                        <div class="col-md-5">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-3">
                                    <img src="{{ asset('assets/img/contoh1.jpg') }}" alt="Pertanahan 1"
                                        class="img-fluid rounded-4" style="object-fit: cover; height: 280px; width: 100%;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-3">
                                    <img src="{{ asset('assets/img/contoh3.jpg') }}" alt="Pertanahan 2"
                                        class="img-fluid rounded-4" style="object-fit: cover; height: 280px; width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container">
            <div class="card border-0 shadow-sm rounded-4 p-5" style="background-color:#ffffff;">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success">Hubungi Kami</h2>
                    <p class="text-muted">Kami siap membantu Anda. Hubungi kami melalui informasi berikut.</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 text-center py-4 rounded-4">
                            <div class="fs-1 text-success mb-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h5 class="fw-bold">Kontak</h5>
                            <p class="text-muted mb-0">(+62) 838-0266-1153</p>
                            <p class="text-muted">pertanahan@gmail.com</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 text-center py-4 rounded-4">
                            <div class="fs-1 text-success mb-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h5 class="fw-bold">Alamat</h5>
                            <p class="text-muted mb-0">Jl. Tegal Sari Gg. IntiSari</p>
                            <p class="text-muted">Kota Pekanbaru, Indonesia</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 text-center py-4 rounded-4">
                            <div class="fs-1 text-success mb-3">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <h5 class="fw-bold">Media Sosial</h5>
                            <div class="d-flex justify-content-center gap-3 mt-2">
                                <a href="#" class="text-success fs-4"><i class="fab fa-facebook"></i></a>
                                <a href="#" class="text-success fs-4"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-success fs-4"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="text-success fs-4"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.354524739826!2d110.3680579152567!3d-7.847713394346404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57df02c8c0e3%3A0x6f2cf53da69e1e33!2sKantor%20Pertanahan!5e0!3m2!1sen!2sid!4v1673023456123!5m2!1sen!2sid"
                        width="100%" height="350" style="border:0; border-radius:15px;" allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <div
            class="shadow-lg rounded-circle"
            style="
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                background-color: #25D366; /* Warna WhatsApp */
                width: 60px;
                height: 60px;
                display: flex; /* Untuk memposisikan ikon di tengah */
                align-items: center;
                justify-content: center;
                transition: all 0.3s;
            ">
            <a href="https://api.whatsapp.com/send?phone=6281234567890" target="_blank" title="Hubungi kami via WhatsApp"
               class="text-white text-decoration-none fs-2">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </section>
@endsection
