@extends('layouts.guest.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="content-wrapper py-4">
<section class="content">
<div class="container-fluid">

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-success">
        📁 Data Dokumen Persil
    </h4>

    <div class="d-flex gap-2">
        <a href="{{ route('dokumen_persil.create') }}"
           class="btn rounded-pill px-3 shadow-sm d-flex align-items-center gap-2"
           style="background:#388e3c;color:white;">
            <i data-feather="plus"></i>
            Tambah Dokumen
        </a>

        <a href="{{ route('dashboard.index') }}"
           class="btn btn-outline-success rounded-pill px-3 shadow-sm d-flex align-items-center gap-2">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
    <div class="card-body py-3">

        <form method="GET"
              action="{{ route('dokumen_persil.index') }}">

            <div class="row g-2 align-items-center">

                {{-- KIRI --}}
                <div class="col-md-8">
                    <div class="row g-2">
                        <div class="col-md-7">
                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Cari kode persil / nomor dokumen..."
                                   value="{{ request('search') }}">
                        </div>

                        <div class="col-md-5">
                            <select name="jenis" class="form-control">
                                <option value="">-- Semua Jenis Dokumen --</option>
                                <option value="Sertifikat" {{ request('jenis')=='Sertifikat'?'selected':'' }}>Sertifikat</option>
                                <option value="AJB" {{ request('jenis')=='AJB'?'selected':'' }}>AJB</option>
                                <option value="SHM" {{ request('jenis')=='SHM'?'selected':'' }}>SHM</option>
                                <option value="IMB" {{ request('jenis')=='IMB'?'selected':'' }}>IMB</option>
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

                    <a href="{{ route('dokumen_persil.index') }}"
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
        @forelse ($dokumens as $dok)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius:12px;">

                {{-- GAMBAR --}}
                @php
                    $images = $dok->media->filter(fn($m) =>
                        Str::startsWith($m->mime_type, 'image')
                    );
                    $filesCount = $dok->media->count();
                @endphp

                <div class="card-image-wrapper">
                    @if ($images->count())
                        <img src="{{ asset('storage/'.$images->first()->file_url) }}"
                             class="card-image">

                        @if ($filesCount > 1)
                            <span class="card-image-badge">
                                +{{ $filesCount - 1 }}
                            </span>
                        @endif
                    @else
                        <div class="card-image-placeholder">
                            <i data-feather="file-text"></i>
                            <span>Belum ada file</span>
                        </div>
                    @endif
                </div>

                {{-- HEADER --}}
                <div class="card-header d-flex align-items-center gap-2 text-white"
                     style="background:#2e7d32;">
                    <i data-feather="folder"></i>
                    <h6 class="mb-0 fw-semibold text-truncate">
    Dokumen #{{ $dok->persil->kode_persil ?? '-' }}
</h6>

                </div>

                {{-- BODY --}}
                <div class="card-body" style="background:#f8f9f8;">


                    <p class="mb-1">
                        <strong>No Dokumen:</strong> {{ $dok->nomor }}
                    </p>
                    <p class="mb-1">
                        <strong>Jenis:</strong> {{ $dok->jenis_dokumen }}
                    </p>
                    <p class="text-muted small mb-0">
                        {{ Str::limit($dok->keterangan ?? 'Tidak ada keterangan.', 80) }}
                    </p>
                </div>

                {{-- FOOTER --}}
                <div class="card-footer bg-white d-flex justify-content-end gap-2">
                    <a href="#detail-dok-{{ $dok->dokumen_id }}"
                       class="btn btn-sm btn-info text-white rounded-pill px-3">
                        <i data-feather="eye" width="14"></i> Detail
                    </a>
                    <a href="{{ route('dokumen_persil.edit', $dok->dokumen_id) }}"
                       class="btn btn-sm btn-warning rounded-pill px-3">
                        <i data-feather="edit" width="14"></i> Edit
                    </a>
                    <form action="{{ route('dokumen_persil.destroy', $dok->dokumen_id) }}"
                          method="POST"
                          onsubmit="return confirm('Hapus dokumen ini?')">
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
        <div class="col-12 text-center py-5">
            <i data-feather="folder-x" width="64" height="64" class="text-muted"></i>
            <p class="text-muted mt-2">Belum ada dokumen.</p>
        </div>
        @endforelse
    </div>
{{ $dokumens->links('pagination::bootstrap-5') }}
</div>
</section>
</div>

{{-- ================= DETAIL OVERLAY ================= --}}
@foreach ($dokumens as $dok)
<div id="detail-dok-{{ $dok->dokumen_id }}" class="detail-overlay">
    <div class="detail-box">

        <div class="detail-header">
            <h5>Detail Dokumen Persil</h5>
            <a href="#" class="close-btn">✕</a>
        </div>

        <div class="detail-body">

            @php
                $images = $dok->media->filter(fn($m) =>
                    Str::startsWith($m->mime_type, 'image')
                );
            @endphp

            {{-- GAMBAR --}}
            @if ($images->count() === 1)
                <div class="detail-image-single detail-image-wrap">
                    <img src="{{ asset('storage/'.$images->first()->file_url) }}"
                         class="detail-image-large">

                    <form action="{{ route('dokumen_persil.media.destroy', [
                        'dokumen' => $dok->dokumen_id,
                        'media'   => $images->first()->media_id
                    ]) }}"
                        method="POST"
                        class="image-delete-form"
                        onsubmit="return confirm('Hapus file ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>

            @elseif ($images->count() > 1)
                <div class="detail-image-grid">
                    @foreach ($images as $img)
                        <div class="detail-image-wrap">
                            <img src="{{ asset('storage/'.$img->file_url) }}"
                                 class="detail-image-grid-img">

                            <div class="image-action-overlay">
                                <a href="{{ asset('storage/'.$img->file_url) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-light">
                                    <i data-feather="eye"></i> Preview
                                </a>

                                <form action="{{ route('dokumen_persil.media.destroy', [
                                    'dokumen' => $dok->dokumen_id,
                                    'media'   => $img->media_id
                                ]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus file ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <hr>

            <p><strong>Persil:</strong> {{ $dok->persil->kode_persil ?? '-' }}</p>
            <p><strong>Jenis:</strong> {{ $dok->jenis_dokumen }}</p>
            <p><strong>Nomor:</strong> {{ $dok->nomor }}</p>
            <p><strong>Keterangan:</strong> {{ $dok->keterangan ?? '-' }}</p>

        </div>
    </div>
</div>
@endforeach

<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace();</script>
@endsection
