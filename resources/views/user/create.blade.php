@extends('layouts.pertanahan.app')

@section('content')
<div class="content-wrapper" style="margin-top: 100px;"> 
    <section class="content">
        <div class="container-fluid">

            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FORM TAMBAH USER --}}
            <div class="card border-0 shadow-sm mb-4" style="background-color: #f8faf8;">
                <div class="card-header text-white" style="background-color: #2e7d32;">
                    <h6 class="mb-0"><i class="fas fa-user-plus me-2"></i> Tambah Data User</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-success">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control border-0 shadow-sm" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-success">Email</label>
                                <input type="email" name="email" class="form-control border-0 shadow-sm" placeholder="Masukkan alamat email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-success">Password</label>
                                <input type="password" name="password" class="form-control border-0 shadow-sm" placeholder="Masukkan password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-success">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control border-0 shadow-sm" placeholder="Ulangi password" required>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-success me-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn text-white" style="background-color: #2e7d32;">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
