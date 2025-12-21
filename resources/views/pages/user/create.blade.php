@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
<section class="content">
<div class="container-fluid">

    {{-- JUDUL HALAMAN --}}
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            <div class="text-center mb-4">
                <h2 class="fw-bold text-success">👤 Tambah Data User</h2>
                <p class="text-muted">
                    Masukkan informasi akun pengguna baru.
                </p>
            </div>

            {{-- CARD FORM --}}
            <div class="card border-0 shadow-sm mb-5 rounded-3"
                 style="background-color:#f8f9f8;">

                {{-- CARD HEADER --}}
                <div class="card-header d-flex align-items-center gap-2"
                     style="background-color:#2e7d32; color:white;">
                    <i data-feather="user-plus"></i>
                    <h6 class="mb-0 fw-semibold">Form User Baru</h6>
                </div>

                {{-- CARD BODY --}}
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            {{-- NAMA --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary fw-semibold">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       class="form-control border-success-subtle"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary fw-semibold">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input type="email"
                                       name="email"
                                       class="form-control border-success-subtle"
                                       placeholder="Masukkan email"
                                       required>
                            </div>

                            {{-- ROLE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary fw-semibold">
                                    Role <span class="text-danger">*</span>
                                </label>
                                <select name="role"
                                        class="form-select border-success-subtle"
                                        required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="klien">Klien</option>
                                </select>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary fw-semibold">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <input type="password"
                                       name="password"
                                       class="form-control border-success-subtle"
                                       placeholder="Masukkan password"
                                       required>
                            </div>

                            {{-- KONFIRMASI PASSWORD --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary fw-semibold">
                                    Konfirmasi Password <span class="text-danger">*</span>
                                </label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control border-success-subtle"
                                       placeholder="Ulangi password"
                                       required>
                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="text-end mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                            <a href="{{ route('user.index') }}"
                               class="btn btn-outline-secondary rounded-pill
                                      d-flex align-items-center gap-1 px-3">
                                <i data-feather="arrow-left"></i>
                                Kembali
                            </a>

                            <button type="submit"
                                    class="btn rounded-pill
                                           d-flex align-items-center gap-1 px-4"
                                    style="background-color:#388e3c; color:white;">
                                <i data-feather="save"></i>
                                Simpan User
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

<script src="https://unpkg.com/feather-icons"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => feather.replace());
</script>
@endsection
