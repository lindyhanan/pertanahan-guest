@extends('layouts.pertanahan.app')

@section('content')
<div class="content-wrapper py-4">

    {{-- HEADER --}}
    <div class="content-header d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h4 class="fw-semibold text-success-emphasis mb-0">
            <i class="fas fa-users-cog me-2 text-success"></i> Daftar User Login
        </h4>
        <a href="{{ route('user.create') }}" class="btn rounded-pill px-3 shadow-sm" style="background-color:#388e3c; color:white;">
            <i class="fa fa-plus me-1"></i> Tambah User
        </a>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- LIST USER --}}
    <div class="row mt-4">
        @forelse($users as $user)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 hover-card overflow-hidden" style="background-color:#f7f9f7;">
                <div class="card-body text-center p-4">
                    <div class="position-relative mb-3">
                        <img src="{{ asset('assets/img/profile.jpg') }}" 
                             alt="Profile" 
                             class="rounded-circle shadow-sm" 
                             width="80" height="80"
                             style="border:3px solid #81c784;">
                    </div>
                    <h5 class="fw-semibold text-success mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>
                    
                    <hr class="my-3">

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('user.edit', $user->id) }}" 
                           class="btn btn-sm btn-outline-success rounded-pill px-3">
                            <i class="fa fa-edit me-1"></i> Edit
                        </a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="fa fa-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="fas fa-inbox fa-3x mb-3"></i>
            <p class="fs-5">Belum ada user terdaftar.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Efek hover lembut --}}
<style>
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
</style>
@endsection
