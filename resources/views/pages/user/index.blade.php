@extends('layouts.guest.app')

@section('content')
    <div class="content-wrapper py-4">

        {{-- HEADER + SEARCH --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">

            <form method="GET" action="{{ route('user.index') }}" class="mb-4 d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari user..."
                    value="{{ $search ?? '' }}">
                <button class="btn btn-success" type="submit">Cari</button>
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Reset</a>
            </form>

            <div class="d-flex justify-content-end align-items-center mb-3 w-100 gap-2">
                <a href="{{ route('user.create') }}"
                    class="btn rounded-pill d-flex align-items-center gap-1 px-3"
                    style="background-color:#388e3c; color:white;">
                    <i data-feather="user-plus"></i>
                    <span>Tambah User</span>
                </a>

                <a href="{{ route('dashboard.index') }}"
                    class="btn btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
                    <i data-feather="arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>

        </div>

        {{-- FLASH MESSAGE --}}
        @if (session('success'))
            <div
                class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2">
                <i data-feather="check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- CARD DATA USER --}}
        <div class="card border-0 shadow-sm mb-4" style="background-color: #f8faf8;">
            <div class="card-header text-white d-flex align-items-center"
                style="background-color: #2e7d32;">
                <i data-feather="user-plus" class="me-2"></i>
                <h6 class="mb-0">Data User</h6>
            </div>

            <div class="card-body">
                <div class="row mt-4">

                    @forelse ($users as $user)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 hover-card p-3"
                                style="background-color:#f7f9f7;">

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


                                {{-- NAMA & EMAIL --}}
                                <h5 class="fw-semibold text-success text-center mb-1">
                                    {{ $user->name }}
                                </h5>

                                <p class="text-muted small text-center mb-1">
                                    {{ $user->email }}
                                </p>

                                {{-- ROLE --}}
                                <p class="text-muted small text-center mb-3">
                                    {{ $user->role }}
                                </p>

                                {{-- BUTTON ACTION --}}
                                <div class="d-flex justify-content-center gap-2 flex-wrap">

                                    <a href="{{ route('user.show', $user->id) }}"
                                        class="btn btn-sm btn-outline-info rounded-pill d-flex align-items-center gap-1 px-3">
                                        <i data-feather="eye"></i>
                                        <span>Detail</span>
                                    </a>

                                    <a href="{{ route('user.edit', $user->id) }}"
                                        class="btn btn-sm btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
                                        <i data-feather="edit-3"></i>
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('user.destroy', $user->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="btn btn-sm btn-outline-danger rounded-pill d-flex align-items-center gap-1 px-3">
                                            <i data-feather="trash-2"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="col-12 text-center py-5 text-muted">
                            <i data-feather="inbox" class="fs-1 mb-2"></i>
                            <p class="fs-5">Belum ada user terdaftar.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </div>

    {{-- Hover --}}
    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>

    {{-- Feather Icons --}}
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
@endsection
