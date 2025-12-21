@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-5">
<section class="content">
<div class="container-fluid">

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2">
            <i data-feather="check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    {{-- JUDUL HALAMAN --}}
<div class="row justify-content-center mb-4">
    <div class="col-md-10 col-lg-9 text-center">
        <h2 class="fw-bold text-success">✍️ Edit Data User</h2>
        <p class="text-muted">
            Perbarui informasi akun pengguna dengan benar.
        </p>
    </div>
</div>


    {{-- CARD --}}
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9">

            <div class="card border-0 shadow-sm rounded-3" style="background:#f8f9f8;">

                {{-- HEADER --}}
                <div class="card-header d-flex align-items-center gap-2 text-white"
                     style="background:#2e7d32;">
                    <i data-feather="edit-3"></i>
                    <h6 class="mb-0 fw-semibold">Edit Data User</h6>
                </div>

                {{-- BODY --}}
                <div class="card-body">

                    <form action="{{ route('user.update', $user->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">

                            {{-- FOTO PROFILE --}}
                            <div class="col-md-4 text-center">
                                <label class="form-label fw-semibold text-success d-block">
                                    Foto Profile
                                </label>

                                <div class="mb-3">
                                    <img src="{{ $user->foto
                                            ? asset('storage/'.$user->foto)
                                            : asset('assets/img/profile.png') }}"
                                         class="rounded-circle shadow-sm"
                                         width="120" height="120"
                                         style="object-fit:cover; border:4px solid #81c784;">
                                </div>

                                <input type="file"
                                       name="foto"
                                       class="form-control shadow-sm"
                                       accept="image/*">

                                <small class="text-muted d-block mt-1">
                                    JPG / PNG • Maks 5MB
                                </small>

                                {{-- ROLE BADGE --}}
                                <div class="mt-3">
                                    <span class="badge rounded-pill
                                        {{ $user->role === 'admin' ? 'bg-danger' :
                                           ($user->role === 'staff' ? 'bg-warning text-dark' : 'bg-success') }}">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </div>
                            </div>

                            {{-- DATA USER --}}
                            <div class="col-md-8">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-success">
                                            Nama
                                        </label>
                                        <input type="text"
                                               name="name"
                                               value="{{ old('name', $user->name) }}"
                                               class="form-control shadow-sm"
                                               required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-success">
                                            Email
                                        </label>
                                        <input type="email"
                                               name="email"
                                               value="{{ old('email', $user->email) }}"
                                               class="form-control shadow-sm"
                                               required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-success">
                                            Role
                                        </label>
                                        <select name="role"
                                                class="form-select shadow-sm"
                                                required>
                                            <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                            <option value="staff" {{ $user->role=='staff' ? 'selected' : '' }}>
                                                Staff
                                            </option>
                                            <option value="klien" {{ $user->role=='klien' ? 'selected' : '' }}>
                                                Klien
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-success">
                                            Password Baru
                                            <small class="text-muted">(opsional)</small>
                                        </label>
                                        <input type="password"
                                               name="password"
                                               class="form-control shadow-sm">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-success">
                                            Konfirmasi Password
                                        </label>
                                        <input type="password"
                                               name="password_confirmation"
                                               class="form-control shadow-sm">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('user.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-4 d-flex align-items-center gap-1">
                                <i data-feather="arrow-left"></i> Kembali
                            </a>

                            <button type="submit"
                                    class="btn rounded-pill px-4 d-flex align-items-center gap-1"
                                    style="background:#388e3c; color:white;">
                                <i data-feather="save"></i> Update Data
                            </button>
                        </div>
                    </form>

                    {{-- HAPUS FOTO --}}
                    @if ($user->foto)
                        <hr>
                        <form action="{{ route('user.photo.destroy', $user->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus foto profile?')"
                              class="text-center">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-outline-danger rounded-pill px-4">
                                <i data-feather="trash-2"></i> Hapus Foto Profile
                            </button>
                        </form>
                    @endif

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
