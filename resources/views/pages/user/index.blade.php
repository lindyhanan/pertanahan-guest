@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-success">
            👤 Manajemen User
        </h4>

        <div class="d-flex gap-2">
            <a href="{{ route('user.create') }}"
               class="btn rounded-pill px-3 d-flex align-items-center gap-1"
               style="background:#388e3c;color:white;">
                <i data-feather="user-plus"></i>
                Tambah User
            </a>

            <a href="{{ route('dashboard.index') }}"
               class="btn btn-outline-success rounded-pill px-3 d-flex align-items-center gap-1">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    {{-- ================= FILTER ================= --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
        <div class="card-body py-3">
            <form method="GET" action="{{ route('user.index') }}">
                <div class="row g-2 align-items-center">

                    {{-- KIRI --}}
                    <div class="col-md-8">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Cari nama atau email user..."
                               value="{{ request('search') }}">
                    </div>

                    {{-- KANAN --}}
                    <div class="col-md-4 d-flex justify-content-end gap-2">
                        <button class="btn btn-success px-4 d-flex align-items-center gap-1">
                            <i data-feather="search" width="16"></i>
                            Cari
                        </button>

                        <a href="{{ route('user.index') }}"
                           class="btn btn-outline-secondary px-3">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- ================= FLASH MESSAGE ================= --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0
                    d-flex align-items-center gap-2">
            <i data-feather="check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ================= GRID USER ================= --}}
    <div class="row mt-3">
        @forelse ($users as $user)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 hover-card p-3"
                     style="background:#f7f9f7;">

                    {{-- FOTO --}}
                    <div class="text-center mb-3">
                        @if ($user->foto)
                            <img src="{{ asset('storage/'.$user->foto) }}"
                                 class="rounded-circle shadow-sm"
                                 width="80" height="80"
                                 style="border:3px solid #81c784; object-fit:cover;">
                        @else
                            <img src="{{ asset('assets/img/profile.png') }}"
                                 class="rounded-circle shadow-sm"
                                 width="80" height="80"
                                 style="border:3px solid #81c784;">
                        @endif
                    </div>

                    {{-- INFO --}}
                    <h5 class="fw-semibold text-success text-center mb-1">
                        {{ $user->name }}
                    </h5>

                    <p class="text-muted small text-center mb-1">
                        {{ $user->email }}
                    </p>

                    <p class="text-muted small text-center mb-3">
                        {{ strtoupper($user->role) }}
                    </p>

                    {{-- AKSI --}}
                    <div class="d-flex justify-content-center gap-2">

    {{-- DETAIL --}}
    <a href="#detail-user-{{ $user->id }}"
       class="btn btn-sm btn-info text-white rounded-pill px-3 d-flex align-items-center gap-1">
        <i data-feather="eye" width="14"></i>
        Detail
    </a>

    {{-- EDIT --}}
    <a href="{{ route('user.edit', $user->id) }}"
       class="btn btn-sm btn-warning rounded-pill px-3 d-flex align-items-center gap-1">
        <i data-feather="edit" width="14"></i>
        Edit
    </a>

    {{-- HAPUS --}}
    <form action="{{ route('user.destroy', $user->id) }}"
          method="POST"
          class="d-inline-flex"
          onsubmit="return confirm('Yakin hapus user ini?')">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-sm btn-danger rounded-pill px-3 d-flex align-items-center gap-1">
            <i data-feather="trash-2" width="14"></i>
            Hapus
        </button>
    </form>

</div>


                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <i data-feather="users" width="64" height="64" class="opacity-25 mb-2"></i>
                <p class="fs-5">Belum ada user terdaftar.</p>
            </div>
        @endforelse
    </div>
    {{-- ================= DETAIL OVERLAY USER ================= --}}
@foreach ($users as $user)
<div id="detail-user-{{ $user->id }}" class="detail-overlay">
    <div class="detail-box">
        <div class="detail-header">
            <h5>Detail User</h5>
            <a href="#" class="close-btn">✕</a>
        </div>

        <div class="detail-body">
            <div class="text-center mb-4">
                @if ($user->foto)
                    <img src="{{ asset('storage/'.$user->foto) }}"
                         class="rounded-circle shadow-sm"
                         width="120" height="120"
                         style="border:4px solid #81c784; object-fit:cover;">
                @else
                    <img src="{{ asset('assets/img/profile.png') }}"
                         class="rounded-circle shadow-sm"
                         width="120" height="120"
                         style="border:4px solid #81c784;">
                @endif
            </div>

            <hr>

            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p>
                <strong>Role:</strong>
                <span class="badge bg-success text-uppercase">
                    {{ $user->role }}
                </span>
            </p>
        </div>
    </div>
</div>
@endforeach


    {{-- ================= PAGINATION ================= --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

</div>



<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace()</script>
@endsection
