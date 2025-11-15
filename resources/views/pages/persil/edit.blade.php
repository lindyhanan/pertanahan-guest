@extends('layouts.guest.app')

@section('content')
    <div class="content-wrapper py-4">
        <section class="content">
            <div class="container-fluid">

                {{-- Card untuk Formulir (Terpusat dengan lebar optimal) --}}
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8"> {{-- Lebar Optimal --}}

                        {{-- Judul Halaman --}}
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-success">✍️ Edit Data Persil</h2>
                            <p class="text-muted">Perbarui rincian untuk Persil #{{ $persil->kode_persil }}.</p>
                        </div>

                        <div class="card border-0 shadow-sm mb-5 rounded-3" style="background-color:#f8f9f8;">

                            {{-- Card Header --}}
                            <div class="card-header d-flex align-items-center gap-2"
                                style="background-color:#2e7d32; color:white;">
                                <i data-feather="edit"></i>
                                <h6 class="mb-0 fw-semibold">Formulir Edit Persil</h6>
                            </div>

                            {{-- Card Body (Formulir) --}}
                            <div class="card-body">
                                <form action="{{ route('persil.update', $persil->persil_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        {{-- Kode Persil --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">Kode Persil <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="kode_persil"
                                                class="form-control border-success-subtle @error('kode_persil') is-invalid @enderror"
                                                value="{{ old('kode_persil', $persil->kode_persil) }}" required
                                                placeholder="Contoh: P001">
                                            @error('kode_persil')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Pemilik Warga ID --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">Pemilik Warga ID <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="pemilik_warga_id"
                                                class="form-control border-success-subtle @error('pemilik_warga_id') is-invalid @enderror"
                                                value="{{ old('pemilik_warga_id', $persil->pemilik_warga_id) }}" required
                                                placeholder="Masukkan ID Warga">
                                            @error('pemilik_warga_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Luas (m2) --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">Luas (m²) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="0.01" min="0" name="luas_m2"
                                                class="form-control border-success-subtle @error('luas_m2') is-invalid @enderror"
                                                value="{{ old('luas_m2', $persil->luas_m2) }}" required
                                                placeholder="Contoh: 150.75">
                                            @error('luas_m2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Penggunaan --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">Jenis Penggunaan</label>
                                            <input type="text" name="penggunaan"
                                                class="form-control border-success-subtle @error('penggunaan') is-invalid @enderror"
                                                value="{{ old('penggunaan', $persil->penggunaan) }}"
                                                placeholder="Contoh: Permukiman/Sawah">
                                            @error('penggunaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Alamat Lahan --}}
                                    <div class="mb-3">
                                        <label class="form-label text-secondary fw-semibold">Alamat Lahan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="alamat_lahan"
                                            class="form-control border-success-subtle @error('alamat_lahan') is-invalid @enderror"
                                            value="{{ old('alamat_lahan', $persil->alamat_lahan) }}" required
                                            placeholder="Contoh: Jl. Kenanga No. 5">
                                        @error('alamat_lahan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        {{-- RT --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">RT</label>
                                            <input type="text" name="rt"
                                                class="form-control border-success-subtle @error('rt') is-invalid @enderror"
                                                value="{{ old('rt', $persil->rt) }}" placeholder="Contoh: 005">
                                            @error('rt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- RW --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">RW</label>
                                            <input type="text" name="rw"
                                                class="form-control border-success-subtle @error('rw') is-invalid @enderror"
                                                value="{{ old('rw', $persil->rw) }}" placeholder="Contoh: 002">
                                            @error('rw')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Tombol Aksi --}}
                                    <div class="text-end mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                                        <a href="{{ route('persil.index') }}"
                                            class="btn btn-outline-secondary rounded-pill d-flex align-items-center gap-1 px-3">
                                            <i data-feather="x-circle"></i> <span>Batal</span>
                                        </a>
                                        <button type="submit" class="btn rounded-pill d-flex align-items-center gap-1 px-4"
                                            style="background-color:#388e3c; color:white;">
                                            <i data-feather="save"></i> <span>Update Data</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    {{-- PASTIKAN SCRIPT INI ADA UNTUK ICON FEATHER --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
@endsection
