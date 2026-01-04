@extends('layouts.guest.app')

@section('content')
    <div class="content-wrapper py-4">
        <section class="content">
            <div class="container-fluid">

                {{-- Judul Halaman --}}
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-success">✏️ Edit Data Warga</h2>
                    <p class="text-muted">Perbarui informasi warga #{{ $warga->warga_id }}.</p>
                </div>

                {{-- Card Form (Terpusat) --}}
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">

                        {{-- Alert Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger shadow-sm border-0">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card border-0 shadow-sm mb-5 rounded-3" style="background-color:#f8f9f8;">

                            {{-- Card Header --}}
                            <div class="card-header d-flex align-items-center gap-2"
                                 style="background-color:#2e7d32; color:white;">
                                <i data-feather="edit"></i>
                                <h6 class="mb-0 fw-semibold">Formulir Edit Warga</h6>
                            </div>

                            {{-- Card Body --}}
                            <div class="card-body">
                                <form action="{{ route('warga.update', $warga->warga_id) }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        {{-- ID Warga --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">
                                                ID Warga
                                            </label>
                                            <input type="text"
                                                   class="form-control border-success-subtle bg-light"
                                                   value="{{ $warga->warga_id }}"
                                                   readonly>
                                            <small class="text-muted">
                                                Nomor ini dibuat otomatis oleh sistem.
                                            </small>
                                        </div>

                                        {{-- Nama --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">
                                                Nama <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   name="nama"
                                                   class="form-control border-success-subtle @error('nama') is-invalid @enderror"
                                                   value="{{ old('nama', $warga->nama) }}"
                                                   required
                                                   placeholder="Masukkan nama warga">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Pekerjaan --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">Pekerjaan</label>
                                            <input type="text"
                                                   name="pekerjaan"
                                                   class="form-control border-success-subtle @error('pekerjaan') is-invalid @enderror"
                                                   value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                                                   placeholder="Contoh: Petani">
                                            @error('pekerjaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- No KTP --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">No KTP</label>
                                            <input type="text"
                                                   name="no_ktp"
                                                   class="form-control border-success-subtle @error('no_ktp') is-invalid @enderror"
                                                   value="{{ old('no_ktp', $warga->no_ktp) }}"
                                                   placeholder="Masukkan nomor KTP">
                                            @error('no_ktp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Telp --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">No Telp</label>
                                            <input type="text"
                                                   name="telp"
                                                   class="form-control border-success-subtle @error('telp') is-invalid @enderror"
                                                   value="{{ old('telp', $warga->telp) }}"
                                                   placeholder="Contoh: 0812xxxx">
                                            @error('telp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">Email</label>
                                            <input type="email"
                                                   name="email"
                                                   class="form-control border-success-subtle @error('email') is-invalid @enderror"
                                                   value="{{ old('email', $warga->email) }}"
                                                   placeholder="Contoh: nama@email.com">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Jenis Kelamin --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">Jenis Kelamin</label>
                                            <select name="jenis_kelamin"
                                                    class="form-select border-success-subtle @error('jenis_kelamin') is-invalid @enderror">
                                                <option value="">-- Pilih --</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Agama (opsional kalau ada fieldnya di DB) --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-secondary fw-semibold">Agama</label>
                                            <input type="text"
                                                   name="agama"
                                                   class="form-control border-success-subtle @error('agama') is-invalid @enderror"
                                                   value="{{ old('agama', $warga->agama) }}"
                                                   placeholder="Contoh: Islam">
                                            @error('agama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Upload Foto --}}
                                    <div class="mb-3">
                                        <label class="form-label text-secondary fw-semibold">
                                            Foto Warga (opsional)
                                        </label>
                                        <input type="file"
                                               name="foto"
                                               class="form-control @error('foto') is-invalid @enderror"
                                               accept="image/*">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>

                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        @if ($warga->foto)
                                            <div class="mt-3">
                                                <p class="mb-1 text-muted">Foto saat ini:</p>
                                                <img src="{{ asset('storage/'.$warga->foto) }}"
                                                     class="rounded shadow-sm"
                                                     style="max-height:150px;">
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Tombol Aksi --}}
                                    <div class="text-end mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                                        <a href="{{ route('warga.index') }}"
                                           class="btn btn-outline-secondary rounded-pill d-flex align-items-center gap-1 px-3">
                                            <i data-feather="arrow-left"></i> <span>Kembali</span>
                                        </a>

                                        <button type="submit"
                                                class="btn rounded-pill d-flex align-items-center gap-1 px-4"
                                                style="background-color:#388e3c; color:white;">
                                            <i data-feather="save"></i> <span>Simpan Perubahan</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
@endsection
