@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">

    {{-- Header --}}
    <div class="content-header d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h4 class="fw-semibold text-success-emphasis mb-0 d-flex align-items-center gap-2">
            <i data-feather="info" class="text-success"></i> Tentang Aplikasi
        </h4>
        <a href="{{ route('dashboard.index') }}" class="btn btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
            <i data-feather="arrow-left"></i> <span>Kembali</span>
        </a>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- Pendahuluan --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-5" style="background-color:#f8f9f8;">
                <h5 class="fw-semibold text-success mb-3">Deskripsi Aplikasi</h5>
                <p class="text-secondary">
                    Aplikasi ini dirancang untuk mempermudah pengelolaan data pertanahan dan warga secara digital.
                    Setiap modul memiliki tujuan spesifik, mulai dari pencatatan data warga, pengelolaan penggunaan lahan, hingga manajemen user dan hak akses.
                    Sistem ini memastikan data tersimpan rapi, mudah diakses, dan dapat dianalisis secara efektif.
                </p>
            </div>

            {{-- Modul --}}
            <div class="row g-4">
                {{-- Modul 1: Warga --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background-color:#f7f9f7;">
                        <img src="{{ asset('assets/img/gambar1.jpg') }}" alt="Modul Warga" class="img-fluid rounded mb-3">
                        <h6 class="fw-semibold text-success mb-2">Modul Warga</h6>
                        <p class="text-secondary small mb-2">
                            Modul ini digunakan untuk mengelola data warga, termasuk:
                        </p>
                        <ul class="text-secondary small ps-3">
                            <li>Pencatatan identitas lengkap (KTP, nama, alamat, kontak)</li>
                            <li>Kategori pekerjaan dan agama</li>
                            <li>Data kontak untuk komunikasi resmi</li>
                        </ul>
                        <p class="text-secondary small mb-0">
                            Tujuan: Memudahkan pencarian dan pemantauan data warga secara akurat.
                        </p>
                    </div>
                </div>

                {{-- Modul 2: Penggunaan Lahan --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background-color:#f7f9f7;">
                        <img src="{{ asset('assets/img/gambar2.jpg') }}" alt="Modul Penggunaan Lahan" class="img-fluid rounded mb-3">
                        <h6 class="fw-semibold text-success mb-2">Modul Penggunaan Lahan</h6>
                        <p class="text-secondary small mb-2">
                            Modul ini digunakan untuk mencatat dan memantau penggunaan lahan, meliputi:
                        </p>
                        <ul class="text-secondary small ps-3">
                            <li>Pencatatan jenis penggunaan lahan (perumahan, pertanian, komersial)</li>
                            <li>Keterangan dan deskripsi area lahan</li>
                            <li>Memantau alokasi dan status lahan</li>
                        </ul>
                        <p class="text-secondary small mb-0">
                            Tujuan: Membantu analisis alokasi lahan dan perencanaan pembangunan.
                        </p>
                    </div>
                </div>

                {{-- Modul 3: User --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background-color:#f7f9f7;">
                        <img src="{{ asset('assets/img/gambar3.jpg') }}" alt="Modul User" class="img-fluid rounded mb-3">
                        <h6 class="fw-semibold text-success mb-2">Modul User</h6>
                        <p class="text-secondary small mb-2">
                            Modul ini digunakan untuk mengelola akun pengguna dan hak akses:
                        </p>
                        <ul class="text-secondary small ps-3">
                            <li>Penambahan, pengeditan, dan penghapusan user</li>
                            <li>Pemberian hak akses sesuai level user</li>
                            <li>Mengelola login dan keamanan aplikasi</li>
                        </ul>
                        <p class="text-secondary small mb-0">
                            Tujuan: Menjamin keamanan sistem dan kontrol akses yang tepat.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Alur Sistem --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mt-5" style="background-color:#f8f9f8;">
                <h5 class="fw-semibold text-success mb-3">Alur Aplikasi</h5>
                <img src="{{ asset('assets/img/gambar.jpg') }}" alt="Alur Aplikasi" class="img-fluid rounded mb-3">
                <p class="text-secondary small mb-2">
                    Alur penggunaan aplikasi:
                </p>
                <ol class="text-secondary small ps-3">
                    <li>Login sebagai user atau admin</li>
                    <li>Kelola data warga (tambah, edit, hapus, lihat detail)</li>
                    <li>Kelola data penggunaan lahan (tambah, edit, hapus)</li>
                    <li>Kelola akun user dan hak akses</li>
                    <li>Mencetak atau menyimpan laporan sesuai kebutuhan</li>
                </ol>
            </div>

        </div>
    </section>
</div>

{{-- Hover card --}}
<style>
.card img {
    max-height: 180px;
    object-fit: cover;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
</style>

{{-- Feather Icons --}}
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>
@endsection
