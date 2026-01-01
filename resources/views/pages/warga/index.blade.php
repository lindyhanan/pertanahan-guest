@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
<section class="content">
<div class="container-fluid">

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2 shadow-sm border-0 d-flex align-items-center gap-2">
            <i data-feather="check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-success">👥 Data Warga</h4>

        <div class="d-flex gap-2">
            <a href="{{ route('warga.create') }}"
               class="btn rounded-pill px-3"
               style="background:#388e3c;color:white;">
                <i data-feather="user-plus"></i> Tambah Warga
            </a>

            <a href="{{ route('dashboard.index') }}"
               class="btn btn-outline-success rounded-pill px-3">
                <i data-feather="arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- FILTER --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
    <div class="card-body py-3">

        <form method="GET" action="{{ route('warga.index') }}">

            <div class="row g-2 align-items-center">

                {{-- KIRI --}}
                <div class="col-md-8">
                    <div class="row g-2">

                        {{-- SEARCH --}}
                        <div class="col-md-7">
                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Cari nama / pekerjaan / email..."
                                   value="{{ request('search') }}">
                        </div>

                        {{-- FILTER JENIS KELAMIN --}}
                        <div class="col-md-5">
                            <select name="jenis_kelamin"
                                    class="form-select">
                                <option value="">Semua Jenis Kelamin</option>
                                <option value="Laki-laki"
                                    {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan"
                                    {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                    </div>
                </div>

                {{-- KANAN --}}
                <div class="col-md-4 d-flex justify-content-end gap-2">
                    <button class="btn btn-success px-4 d-flex align-items-center gap-1">
                        <i data-feather="search" width="16"></i>
                        Cari
                    </button>

                    <a href="{{ route('warga.index') }}"
                       class="btn btn-outline-secondary px-3">
                        Reset
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>



    {{-- GRID CARD --}}
    <div class="row">
        @forelse ($warga as $w)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow h-100">

                    {{-- HEADER --}}
                    <div class="card-header d-flex align-items-center gap-2"
                         style="background:#2e7d32;color:white;">
                        <i data-feather="user"></i>
                        <h6 class="mb-0 fw-semibold text-truncate">
                            {{ $w->nama }}
                        </h6>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body" style="background:#f8f9f8;">
                        <p><strong>ID Warga:</strong> {{ $w->warga_id }}</p>
                        <p><strong>Pekerjaan:</strong> {{ $w->pekerjaan ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $w->email }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ $w->jenis_kelamin }}</p>
                        <p><strong>Telp:</strong> {{ $w->telp }}</p>
                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer bg-white d-flex justify-content-end gap-2">
                        <a href="#detail-warga-{{ $w->warga_id }}"
                           class="btn btn-sm btn-info text-white rounded-pill">
                            <i data-feather="eye" width="14"></i> Detail
                        </a>

                        <a href="{{ route('warga.edit', $w->warga_id) }}"
                           class="btn btn-sm btn-warning rounded-pill">
                            <i data-feather="edit" width="14"></i> Edit
                        </a>

                        <form action="{{ route('warga.destroy', $w->warga_id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus data warga ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger rounded-pill">
                                <i data-feather="trash-2" width="14"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <i data-feather="inbox" class="mb-2"></i>
                <p>Belum ada data warga.</p>
            </div>
        @endforelse
    </div>

    {{ $warga->links('pagination::bootstrap-5') }}

</div>
</section>
</div>

{{-- DETAIL OVERLAY --}}
@foreach ($warga as $w)
<div id="detail-warga-{{ $w->warga_id }}" class="detail-overlay">
    <div class="detail-box">

        <div class="detail-header">
            <h5>Detail Warga</h5>
            <a href="#" class="close-btn">✕</a>
        </div>

        <div class="detail-body">
            <div class="detail-grid">
                <div><strong>ID</strong><div>{{ $w->warga_id }}</div></div>
                <div><strong>Nama</strong><div>{{ $w->nama }}</div></div>
                <div><strong>Pekerjaan</strong><div>{{ $w->pekerjaan ?? '-' }}</div></div>
                <div><strong>Jenis Kelamin</strong><div>{{ $w->jenis_kelamin ?? '-' }}</div></div>
                <div><strong>No KTP</strong><div>{{ $w->no_ktp }}</div></div>
                <div><strong>Telp</strong><div>{{ $w->telp }}</div></div>
                <div><strong>Email</strong><div>{{ $w->email }}</div></div>
            </div>
        </div>

    </div>
</div>
@endforeach

<script>
document.addEventListener('DOMContentLoaded', () => feather.replace());
</script>
@endsection
