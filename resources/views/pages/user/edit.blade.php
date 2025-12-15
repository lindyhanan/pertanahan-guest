@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper" style="margin-top:100px;">
<section class="content">
<div class="container-fluid">

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2">
            <i data-feather="check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4" style="background:#f8faf8;">
        <div class="card-header text-white d-flex align-items-center gap-2" style="background:#2e7d32;">
            <i data-feather="edit-3"></i>
            <h6 class="mb-0">Edit Data User</h6>
        </div>

        <div class="card-body">

            {{-- ===============================
               FORM UPDATE USER
               =============================== --}}
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

                        <div class="profile-photo-wrapper mx-auto mb-2">
                            <div class="profile-photo-box">
                                <img
                                    src="{{ $user->foto
                                        ? asset('storage/'.$user->foto)
                                        : asset('assets/img/profile.png') }}"
                                    class="profile-photo-img"
                                    alt="Foto Profile">
                            </div>
                        </div>

                        <input type="file"
                               name="foto"
                               class="form-control"
                               accept="image/*">

                        <small class="text-muted d-block mt-1">
                            JPG / PNG • Max 5MB
                        </small>
                    </div>

                    {{-- DATA USER --}}
                    <div class="col-md-8">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-success">Nama</label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       class="form-control shadow-sm"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-success">Email</label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="form-control shadow-sm"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-success">Role</label>
                                <select name="role" class="form-select shadow-sm" required>
                                    <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="staff" {{ $user->role=='staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="klien" {{ $user->role=='klien' ? 'selected' : '' }}>Klien</option>
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

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('user.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-4">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn text-white rounded-pill px-4"
                            style="background:#2e7d32;">
                        <i data-feather="save"></i> Update
                    </button>
                </div>
            </form>

            {{-- ===============================
               FORM HAPUS FOTO (AMAN)
               =============================== --}}
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
</section>
</div>

<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>
@endsection
