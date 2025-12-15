@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
<section class="content">
<div class="container-fluid">

    {{-- FILTER --}}
    <form method="GET" action="{{ route('penggunaan.index') }}" class="mb-4 row g-2 align-items-center">
        <div class="col-md-6">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari nama atau keterangan..."
                   value="{{ $search ?? '' }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-success">Cari</button>
            <a href="{{ route('penggunaan.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    {{-- ACTION --}}
    <div class="d-flex justify-content-end mb-3 gap-2">
        <a href="{{ route('penggunaan.create') }}"
           class="btn rounded-pill px-3"
           style="background:#388e3c;color:white;">
            <i data-feather="plus"></i> Tambah Penggunaan
        </a>
        <a href="{{ route('dashboard.index') }}"
           class="btn btn-outline-success rounded-pill px-3">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </div>

    {{-- GRID CARD --}}
    <div class="row">
        @forelse ($data_penggunaan as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow h-100">

                    {{-- HEADER --}}
                    <div class="card-header d-flex align-items-center gap-2"
                         style="background:#2e7d32;color:white;">
                        <i data-feather="leaf"></i>
                        <h6 class="mb-0 fw-semibold">
                            {{ $item->nama_penggunaan }}
                        </h6>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body" style="background:#f8f9f8;">
                        <p class="mb-2">
                            <strong class="text-secondary">ID:</strong>
                            {{ $item->jenis_id }}
                        </p>
                        <p class="text-muted small mb-0">
                            {{ Str::limit($item->keterangan, 80) }}
                        </p>
                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer bg-white d-flex justify-content-end gap-2">
                        <a href="#detail-penggunaan-{{ $item->jenis_id }}"
                           class="btn btn-sm btn-info text-white rounded-pill px-3">
                            <i data-feather="eye" width="14"></i> Detail
                        </a>

                        <a href="{{ route('penggunaan.edit', $item->jenis_id) }}"
                           class="btn btn-sm btn-warning rounded-pill px-3">
                            <i data-feather="edit" width="14"></i> Edit
                        </a>

                        <form action="{{ route('penggunaan.destroy', $item->jenis_id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger rounded-pill px-3">
                                <i data-feather="trash-2" width="14"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <i data-feather="inbox" class="mb-2"></i>
                <p>Belum ada data penggunaan.</p>
            </div>
        @endforelse
    </div>

    {{ $data_penggunaan->links('pagination::bootstrap-5') }}

</div>
</section>
</div>

{{-- ================= DETAIL OVERLAY ================= --}}
@foreach ($data_penggunaan as $item)
<div id="detail-penggunaan-{{ $item->jenis_id }}" class="detail-overlay">
    <div class="detail-box">

        {{-- HEADER --}}
        <div class="detail-header">
            <h5>Detail Penggunaan</h5>
            <a href="#" class="close-btn">✕</a>
        </div>

        {{-- BODY --}}
        <div class="detail-body">

            <div class="detail-grid">
                <div>
                    <strong>Nama Penggunaan</strong>
                    <div>{{ $item->nama_penggunaan }}</div>
                </div>

                <div>
                    <strong>ID</strong>
                    <div>{{ $item->jenis_id }}</div>
                </div>

                <div style="grid-column:1/-1;">
                    <strong>Keterangan</strong>
                    <div>{{ $item->keterangan ?? '-' }}</div>
                </div>

                <div>
                    <strong>Dibuat</strong>
                    <div>{{ $item->created_at->format('d M Y') }}</div>
                </div>

                <div>
                    <strong>Update</strong>
                    <div>{{ $item->updated_at->format('d M Y') }}</div>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach


<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace();</script>
@endsection
