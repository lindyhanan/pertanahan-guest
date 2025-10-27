@extends('layouts.pertanahan.app')

@section('content')
<div class="content-wrapper" style="margin-top: 100px;">
    <section class="content">
        <div class="container-fluid">

            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2">
                    <i data-feather="check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FORM EDIT USER --}}
            <div class="card border-0 shadow-sm mb-4" style="background-color: #f8faf8;">
                <div class="card-header text-white d-flex align-items-center gap-2" style="background-color: #2e7d32;">
                    <i data-feather="edit-3"></i>
                    <h6 class="mb-0">Edit Data User</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-success">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control border-0 shadow-sm" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-success">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control border-0 shadow-sm" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-success">
                                    Password Baru
                                    <small class="text-muted">(Kosongkan jika tidak diubah)</small>
                                </label>
                                <input type="password" name="password" class="form-control border-0 shadow-sm">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-success">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control border-0 shadow-sm">
                            </div>
                        </div>
                        <div class="text-end mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-success d-flex align-items-center gap-1">
                                <i data-feather="arrow-left"></i> <span>Kembali</span>
                            </a>
                            <button type="submit" class="btn text-white d-flex align-items-center gap-1" style="background-color: #2e7d32;">
                                <i data-feather="save"></i> <span>Update</span>
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
