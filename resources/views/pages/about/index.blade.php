@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-success d-flex align-items-center gap-2">
            <i data-feather="info"></i>
            Tentang Aplikasi
        </h4>

        <a href="{{ route('dashboard.index') }}"
           class="btn btn-outline-success rounded-pill px-3 d-flex align-items-center gap-1">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- DESKRIPSI APLIKASI --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
        <div class="card-body">
            <h6 class="fw-semibold text-success mb-2">
                Sistem Informasi Pertanahan
            </h6>
            <p class="text-muted mb-0">
                Sistem informasi berbasis web untuk mendukung pengelolaan data
                pertanahan, warga, persil, serta administrasi secara terstruktur,
                aman, dan efisien.
            </p>
        </div>
    </div>

    {{-- FITUR UTAMA --}}
    <div class="row g-4 mb-4">

        {{-- WARGA --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
                <img src="{{ asset('assets/img/gambar1.jpg') }}"
                     class="card-img-top"
                     style="height:160px;object-fit:cover;">

                <div class="card-body">
                    <h6 class="fw-semibold text-success mb-1">
                        Manajemen Warga
                    </h6>
                    <p class="text-muted small mb-0">
                        Pencatatan dan pengelolaan data identitas warga
                        secara terpusat dan akurat.
                    </p>
                </div>
            </div>
        </div>

        {{-- PERSIL --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
                <img src="{{ asset('assets/img/gambar2.jpg') }}"
                     class="card-img-top"
                     style="height:160px;object-fit:cover;">

                <div class="card-body">
                    <h6 class="fw-semibold text-success mb-1">
                        Data Persil & Lahan
                    </h6>
                    <p class="text-muted small mb-0">
                        Pengelolaan persil, penggunaan lahan, peta,
                        serta informasi kepemilikan.
                    </p>
                </div>
            </div>
        </div>

        {{-- USER --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;">
                <img src="{{ asset('assets/img/gambar3.jpg') }}"
                     class="card-img-top"
                     style="height:160px;object-fit:cover;">

                <div class="card-body">
                    <h6 class="fw-semibold text-success mb-1">
                        Manajemen Pengguna
                    </h6>
                    <p class="text-muted small mb-0">
                        Pengaturan akun pengguna dan hak akses
                        sesuai peran masing-masing.
                    </p>
                </div>
            </div>
        </div>

    </div>

    {{-- HAK AKSES --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
        <div class="card-body">
            <h6 class="fw-semibold text-success mb-3">
                Hak Akses Pengguna
            </h6>

            <ul class="list-unstyled mb-0">
                <li class="mb-2">
                    <span class="badge bg-danger me-2">Admin</span>
                    Mengelola seluruh data dan konfigurasi sistem.
                </li>
                <li class="mb-2">
                    <span class="badge bg-warning text-dark me-2">Staff</span>
                    Mengelola data operasional sesuai kewenangan.
                </li>
                <li>
                    <span class="badge bg-success me-2">Klien</span>
                    Melihat data dan informasi yang diizinkan.
                </li>
            </ul>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="text-center text-muted small mt-4">
        © {{ date('Y') }} Sistem Informasi Pertanahan • Versi 1.0
    </div>

</div>

<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace()</script>
@endsection
