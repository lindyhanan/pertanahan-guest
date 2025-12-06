@extends('layouts.guest.app')

@section('content')
    <div class="content-wrapper" style="margin-top: 100px;">
        <section class="content">
            <div class="container-fluid">

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div
                        class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center">
                        <i data-feather="check-circle" class="me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
                    </a>
                    <a href="{{ route('dashboard.index') }}"
                        class="btn btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
                        <i data-feather="arrow-left"></i> <span>Kembali</span>
                    </a>
                </div>
                <div class="card border-0 shadow-sm mb-4" style="background-color: #f8faf8;">
                    <div class="card-header text-white d-flex align-items-center" style="background-color: #2e7d32;">
                        <i data-feather="user-plus" class="me-2"></i>
                        <h6 class="mb-0">Tambah Data User</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-success">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control border-0 shadow-sm"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-success">Email</label>
                                    <input type="email" name="email" class="form-control border-0 shadow-sm"
                                        placeholder="Masukkan alamat email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-success">Role</label>
                                    <select name="role" class="form-control border-0 shadow-sm" required>
                                        <option value="admin">Admin</option>
                                        <option value="staff" selected>Staff</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-success">Password</label>
                                    <input type="password" name="password" class="form-control border-0 shadow-sm"
                                        placeholder="Masukkan password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-success">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control border-0 shadow-sm" placeholder="Ulangi password" required>
                                </div>
                            </div>
                            <div class="text-end mt-3 d-flex justify-content-end gap-2">
                                <button type="reset"
                                    class="btn btn-outline-secondary rounded-pill d-flex align-items-center gap-1 px-3">
                                    <i data-feather="rotate-ccw"></i> <span>Reset</span>
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
        </section>
    </div>

    {{-- Feather Icons --}}
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
@endsection
