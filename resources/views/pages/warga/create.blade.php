@extends('layouts.guest.app')

@section('content')
    <div class="content-wrapper py-4">
        <section class="content">
            <div class="container-fluid">

                {{-- ALERT FLASH MESSAGE --}}
                @if (session('success'))
                    <div
                        class="alert alert-success alert-dismissible fade show mt-2 shadow-sm border-0 d-flex align-items-center gap-2">
                        <i data-feather="check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- WRAPPER UNTUK MEMUSATKAN FORMULIR --}}
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-9"> {{-- Lebar Optimal --}}

                        {{-- JUDUL HALAMAN --}}
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-success">👤 Tambah Data Warga</h2>
                            <p class="text-muted">Lengkapi data diri warga baru sesuai kartu identitas (KTP).</p>
                        </div>

                        <div class="card border-0 shadow-sm mb-5 rounded-3" style="background-color:#f8f9f8;">

                            {{-- Card Header --}}
                            <div class="card-header d-flex align-items-center gap-2"
                                style="background-color:#2e7d32; color:white;">
                                <i data-feather="user-plus"></i>
                                <h6 class="mb-0 fw-semibold">Formulir Pendaftaran Warga</h6>
                            </div>

                            {{-- Card Body (Formulir) --}}
                            <div class="card-body">
                                <form action="{{ route('warga.store') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        {{-- Nomor KTP --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Nomor KTP <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="no_ktp" maxlength="16"
                                                class="form-control border-success-subtle" value="{{ old('no_ktp') }}"
                                                required placeholder="16 digit angka KTP">
                                        </div>

                                        {{-- Nama Lengkap --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Nama Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="nama" maxlength="50"
                                                class="form-control border-success-subtle" value="{{ old('nama') }}"
                                                required placeholder="Nama lengkap sesuai KTP">
                                        </div>

                                        {{-- Alamat --}}
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Alamat <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="alamat" class="form-control border-success-subtle"
                                                value="{{ old('alamat') }}" required
                                                placeholder="Contoh: Jl. Kenanga No. 5, RT/RW, Desa/Kelurahan">
                                        </div>

                                        {{-- Jenis Kelamin --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Jenis Kelamin <span
                                                    class="text-danger">*</span></label>
                                            <select name="jenis_kelamin" class="form-select border-success-subtle" required>
                                                <option value="">-- Pilih --</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>

                                        {{-- Agama --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Agama <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="agama" class="form-control border-success-subtle"
                                                value="{{ old('agama') }}" required placeholder="Contoh: Islam/Kristen">
                                        </div>

                                        {{-- Pekerjaan --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Pekerjaan <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="pekerjaan"
                                                class="form-control border-success-subtle" value="{{ old('pekerjaan') }}"
                                                required placeholder="Contoh: Wiraswasta/PNS">
                                        </div>

                                        {{-- Nomor Telepon --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Nomor Telepon <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="telp" class="form-control border-success-subtle"
                                                value="{{ old('telp') }}" required placeholder="Contoh: 0812xxxxxx">
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control border-success-subtle"
                                                value="{{ old('email') }}" required
                                                placeholder="Contoh: nama@example.com">
                                        </div>

                                    </div>

                                    {{-- TOMBOL Aksi --}}
                                    <div class="text-end mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                                        <button type="reset"
                                            class="btn btn-outline-secondary rounded-pill d-flex align-items-center gap-1 px-3">
                                            <i data-feather="rotate-ccw"></i> <span>Reset Form</span>
                                        </button>
                                        <button type="submit" class="btn rounded-pill d-flex align-items-center gap-1 px-4"
                                            style="background-color:#388e3c; color:white;">
                                            <i data-feather="save"></i> <span>Simpan Data</span>
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
