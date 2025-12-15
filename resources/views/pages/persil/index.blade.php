@extends('layouts.guest.app')

@php
    use Illuminate\Support\Str;
@endphp

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

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-2 shadow-sm border-0 d-flex align-items-center gap-2">
            <i data-feather="x-circle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-success">🏡 Data Persil Tanah</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('persil.create') }}" class="btn rounded-pill px-3" style="background:#388e3c;color:white;">
                <i data-feather="plus"></i> Tambah Persil
            </a>
            <a href="{{ route('dashboard.index') }}" class="btn btn-outline-success rounded-pill px-3">
                <i data-feather="arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('persil.index') }}" class="mb-4 row g-2 align-items-center">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                placeholder="Cari kode atau alamat..." value="{{ $search ?? '' }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="pemilik" class="form-control"
                placeholder="Filter Pemilik (ID)" value="{{ $pemilik ?? '' }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-success">Terapkan</button>
            <a href="{{ route('persil.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    {{-- GRID CARD --}}
    <div class="row">
        @forelse ($persil as $p)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow h-100">
                    @php
    $images = $p->media->filter(fn($m) =>
        \Illuminate\Support\Str::startsWith($m->mime_type, 'image')
    );

    $filesCount = $p->media->count();
@endphp

<div class="card-image-wrapper">

    {{-- ADA GAMBAR --}}
    @if ($images->count())
        <img src="{{ asset('storage/'.$images->first()->file_url) }}"
             class="card-image">

        @if ($filesCount > 1)
            <span class="card-image-badge">
                +{{ $filesCount - 1 }}
            </span>
        @endif

    {{-- TIDAK ADA GAMBAR, TAPI ADA FILE (PDF DLL) --}}
    @elseif ($filesCount)
    <div class="card-image-placeholder pdf-cover">
        <i data-feather="file-text"></i>
        <span>{{ $filesCount }} File</span>
    </div>

    {{-- TIDAK ADA FILE --}}
    @else
        <div class="card-image-placeholder">
            <i data-feather="image"></i>
            <span>Belum upload file</span>
        </div>
    @endif

</div>


                    <div class="card-header d-flex align-items-center gap-2" style="background:#2e7d32;color:white;">
                        <i data-feather="map-pin"></i>
                        <h6 class="mb-0 fw-semibold">PERSIL #{{ $p->kode_persil }}</h6>
                    </div>

                    <div class="card-body" style="background:#f8f9f8;">
                        <p><strong>Pemilik:</strong> {{ $p->pemilik_warga_id }}</p>
                        <p>
                            <strong>Luas:</strong>
                            <span class="fw-bold text-success">
                                {{ number_format($p->luas_m2, 0, ',', '.') }} m²
                            </span>
                        </p>
                        <p><strong>Alamat:</strong> {{ $p->alamat_lahan }}</p>
                    </div>

                    <div class="card-footer bg-white d-flex justify-content-end gap-2">
                        <a href="#detail-{{ $p->persil_id }}" class="btn btn-sm btn-info text-white rounded-pill">
                            <i data-feather="eye" width="14"></i> Detail
                        </a>
                        <a href="{{ route('persil.edit', $p->persil_id) }}" class="btn btn-sm btn-warning rounded-pill">
                            <i data-feather="edit" width="14"></i> Edit
                        </a>
                        <form action="{{ route('persil.destroy', $p->persil_id) }}" method="POST"
                              onsubmit="return confirm('Hapus persil {{ $p->kode_persil }}?')">
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
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada data persil.</p>
            </div>
        @endforelse
    </div>

    {{ $persil->links('pagination::bootstrap-5') }}

    {{-- DETAIL OVERLAY --}}
    @foreach ($persil as $p)
        <div id="detail-{{ $p->persil_id }}" class="detail-overlay">
            <div class="detail-box">

                <div class="detail-header">
                    <h5>Detail Persil #{{ $p->kode_persil }}</h5>
                    <a href="#" class="close-btn">✕</a>
                </div>

                <div class="detail-body">

                    @php
    $images = $p->media->filter(fn($m) =>
        \Illuminate\Support\Str::startsWith($m->mime_type, 'image')
    );

    $files = $p->media;
@endphp

{{-- ========== TIDAK ADA FILE ========== --}}
@if ($files->isEmpty())
    <p class="text-muted small">Belum ada file.</p>

@else

    {{-- ========== GAMBAR ========== --}}
    @if ($images->count() === 1)
        @php $img = $images->first(); @endphp

        <div class="detail-image-single detail-image-wrap">
            <img src="{{ asset('storage/'.$img->file_url) }}"
                 class="detail-image-large">

            {{-- HAPUS --}}
            <form action="{{ route('persil.media.destroy', [
                    'persil' => $p->persil_id,
                    'media'  => $img->media_id
                ]) }}"
                method="POST"
                class="image-delete-form"
                onsubmit="return confirm('Hapus file ini?')">
                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger">
                    Hapus
                </button>
            </form>
        </div>

    @elseif ($images->count() > 1)
        <div class="detail-image-grid">
            @foreach ($images as $img)
                <div class="detail-image-wrap">

    <img src="{{ asset('storage/'.$img->file_url) }}"
         class="detail-image-grid-img">

    {{-- OVERLAY AKSI --}}
    <div class="image-action-overlay">

        {{-- PREVIEW --}}
        <a href="{{ asset('storage/'.$img->file_url) }}"
           target="_blank"
           class="btn btn-sm btn-light d-flex align-items-center gap-1">
            <i data-feather="eye"></i>
            Preview
        </a>

        {{-- HAPUS --}}
        <form action="{{ route('persil.media.destroy', [
                'persil' => $p->persil_id,
                'media'  => $img->media_id
            ]) }}"
            method="POST"
            onsubmit="return confirm('Hapus file ini?')">
            @csrf
            @method('DELETE')

            <button class="btn btn-sm btn-danger d-flex align-items-center gap-1">
                <i data-feather="trash-2"></i>
                Hapus
            </button>
        </form>

    </div>
</div>

            @endforeach
        </div>
    @endif

    {{-- ========== FILE PDF / NON-GAMBAR ========== --}}
    @php
        $nonImages = $files->filter(fn($m) =>
            !\Illuminate\Support\Str::startsWith($m->mime_type, 'image')
        );
    @endphp

    @if ($nonImages->count())
        <div class="mt-3">
            <h6 class="fw-semibold mb-2">File Dokumen</h6>

            @foreach ($nonImages as $file)
                <div class="detail-image-wrap border rounded p-3 d-flex align-items-center gap-2">

    <i data-feather="file-text"></i>

    <a href="{{ asset('storage/'.$file->file_url) }}"
       target="_blank"
       class="fw-semibold text-decoration-none">
        {{ basename($file->file_url) }}
    </a>

    {{-- OVERLAY --}}
    <div class="image-action-overlay">

        {{-- PREVIEW --}}
        <a href="{{ asset('storage/'.$file->file_url) }}"
           target="_blank"
           class="btn btn-sm btn-light">
            <i data-feather="eye"></i>
        </a>

        {{-- HAPUS --}}
        <form action="{{ route('persil.media.destroy', [
                'persil' => $p->persil_id,
                'media'  => $file->media_id
            ]) }}"
            method="POST"
            onsubmit="return confirm('Hapus file ini?')">
            @csrf
            @method('DELETE')

            <button class="btn btn-sm btn-danger">
                <i data-feather="trash-2"></i>
            </button>
        </form>

    </div>
</div>

            @endforeach
        </div>
    @endif

@endif


                    <hr>

                    <p><strong>Pemilik:</strong> {{ $p->pemilik_warga_id }}</p>
                    <p><strong>Luas:</strong> {{ number_format($p->luas_m2, 0, ',', '.') }} m²</p>
                    <p><strong>Alamat:</strong> {{ $p->alamat_lahan }}</p>
                    <p><strong>Dibuat:</strong> {{ $p->created_at->format('d M Y') }}</p>
                    <p><strong>Update:</strong> {{ $p->updated_at->format('d M Y') }}</p>

                </div>
            </div>
        </div>
    @endforeach

</div>
</section>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => feather.replace());
</script>
@endsection
