@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
<section class="content">
{{-- ================= HEADER & SEARCH ================= --}}
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">

    {{-- JUDUL --}}
    <div>
        <h4 class="fw-bold text-success mb-1">
            <i data-feather="map"></i> Peta Persil
        </h4>
    </div>

    {{-- AKSI --}}
    <div class="d-flex gap-2">
        <a href="{{ route('peta_persil.create') }}"
           class="btn rounded-pill px-4 shadow-sm d-flex align-items-center gap-2"
           style="background:#388e3c;color:white;">
            <i data-feather="plus" width="16"></i>
            Tambah Peta
        </a>

        <a href="{{ route('dashboard.index') }}"
           class="btn btn-outline-success rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
            <i data-feather="arrow-left" width="16"></i>
            Dashboard
        </a>
    </div>
</div>

{{-- ================= SEARCH BOX ================= --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
    <div class="card-body py-3">

        <form method="GET"
              action="{{ route('peta_persil.index') }}">

            <div class="row g-2 align-items-center">

                {{-- KIRI: SEARCH --}}
                <div class="col-md-8">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari kode persil / peta..."
                           value="{{ request('search') }}">
                </div>

                {{-- KANAN: BUTTON --}}
                <div class="col-md-4 d-flex justify-content-end gap-2">
                    <button class="btn btn-success px-4 d-flex align-items-center gap-1">
                        <i data-feather="search" width="16"></i>
                        Cari
                    </button>

                    <a href="{{ route('peta_persil.index') }}"
                       class="btn btn-outline-secondary px-3">
                        Reset
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>



    {{-- GRID --}}
    <div class="row">
        @forelse ($peta as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100 peta-card">

                    {{-- GAMBAR --}}
                    @php
                        $images = $item->media->filter(fn($m) =>
                            \Illuminate\Support\Str::startsWith($m->mime_type, 'image')
                        );
                        $filesCount = $item->media->count();
                    @endphp

                    <div class="card-image-wrapper">
                        @if ($images->count())
                            <img src="{{ asset('storage/'.$images->first()->file_url) }}">

                            @if ($filesCount > 1)
                                <span class="card-image-badge">
                                    +{{ $filesCount - 1 }}
                                </span>
                            @endif
                        @else
                            <div class="card-image-placeholder">
                                <i data-feather="image" width="42"></i>
                                <span>Tidak ada foto</span>
                            </div>
                        @endif
                    </div>

                    {{-- HEADER --}}
                    <div class="card-header d-flex align-items-center gap-2 text-white border-0 py-3"
                         style="background:#2e7d32;">
                        <i data-feather="map" width="18"></i>
                        <h6 class="mb-0 fw-bold text-truncate">
                            {{ $item->persil
                                ? 'Peta Persil #'.$item->persil->kode_persil
                                : 'Peta Persil'
                            }}
                        </h6>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body py-3" style="background:#fcfdfc;">
                        <div class="row text-center">
                            {{-- PREVIEW BIDANG SEDERHANA --}}
@if($item->panjang_m && $item->lebar_m)
    <div class="peta-preview mb-3">
        <div class="peta-box">
            <span>{{ $item->panjang_m }} m</span>
            <small>×</small>
            <span>{{ $item->lebar_m }} m</span>
        </div>
    </div>
@else
    <div class="peta-preview-empty mb-3">
        <i data-feather="map"></i>
        <small>Dimensi belum tersedia</small>
    </div>
@endif
<div class="text-center mt-2">
    <small class="text-muted">Estimasi Luas</small>
    <div class="fw-bold text-success">
        {{ $item->panjang_m * $item->lebar_m }} m²
    </div>
</div>

                            <div class="col-6 border-end">
                                <small class="text-secondary d-block">Panjang</small>
                                <span class="fw-bold">{{ $item->panjang_m }} m</span>
                            </div>
                            <div class="col-6">
                                <small class="text-secondary d-block">Lebar</small>
                                <span class="fw-bold">{{ $item->lebar_m }} m</span>
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer bg-white d-flex justify-content-end gap-2 border-0 py-3">
                        <a href="#detail-peta-{{ $item->peta_id }}"
                           class="btn btn-sm btn-info text-white rounded-pill px-3">
                            <i data-feather="eye" width="14"></i> Detail
                        </a>

                        <a href="{{ route('peta_persil.edit', $item->peta_id) }}"
                           class="btn btn-sm btn-warning rounded-pill px-3">
                            <i data-feather="edit" width="14"></i> Edit
                        </a>

                        <form action="{{ route('peta_persil.destroy', $item->peta_id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus data peta ini?')">
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
                <i data-feather="map-pin" width="64" height="64" class="opacity-25 mb-3"></i>
                <h5 class="text-muted">Data peta belum tersedia</h5>
            </div>
        @endforelse
    </div>
    {{ $peta->links('pagination::bootstrap-5') }}
{{-- DETAIL OVERLAY PETA PERSIL (SAMA DENGAN DETAIL PERSIL) --}}
@foreach ($peta as $p)
<div id="detail-peta-{{ $p->peta_id }}" class="detail-overlay">
    <div class="detail-box">
        <div class="detail-header">
            <h5>
                Detail Peta Persil #
                {{ $p->persil?->kode_persil ?? $p->peta_id }}
            </h5>
            <a href="#" class="close-btn">✕</a>
        </div>
        <div class="detail-body">
            @php
                $images = $p->media->filter(fn($m) =>
                    \Illuminate\Support\Str::startsWith($m->mime_type, 'image')
                );
                $files = $p->media;
            @endphp

            {{-- ================= TIDAK ADA FILE ================= --}}
            @if ($files->isEmpty())
                <p class="text-muted small">Belum ada file.</p>
            @else
                {{-- ================= GAMBAR ================= --}}
                @if ($images->count() === 1)
                    @php $img = $images->first(); @endphp

                    <div class="detail-image-single detail-image-wrap">
                        <img src="{{ asset('storage/'.$img->file_url) }}"
                             class="detail-image-large">

                        {{-- HAPUS --}}
                        <form action="{{ route('peta_persil.media.destroy', [
                                'peta'  => $p->peta_id,
                                'media' => $img->media_id
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
                                    <form action="{{ route('peta_persil.media.destroy', [
                                            'peta'  => $p->peta_id,
                                            'media' => $img->media_id
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

                {{-- ================= FILE NON-GAMBAR (PDF DLL) ================= --}}
                @php
                    $nonImages = $files->filter(fn($m) =>
                        !\Illuminate\Support\Str::startsWith($m->mime_type, 'image')
                    );
                @endphp

                @if ($nonImages->count())
                    <div class="mt-3">
                        <h6 class="fw-semibold mb-2">File Dokumen</h6>

                        @foreach ($nonImages as $file)
                            <div class="detail-image-wrap border rounded p-3
                                        d-flex align-items-center gap-2">

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
                                    <form action="{{ route('peta_persil.media.destroy', [
                                            'peta'  => $p->peta_id,
                                            'media' => $file->media_id
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

            {{-- INFO PETA --}}
            <p><strong>Kode Peta:</strong> PETA-{{ $p->peta_id }}</p>
            <p><strong>Persil:</strong> {{ $p->persil?->kode_persil ?? '-' }}</p>
            <p><strong>Dimensi:</strong> {{ $p->panjang_m }} m × {{ $p->lebar_m }} m</p>
            <p>
                <strong>Estimasi Luas:</strong>
                <span class="fw-bold text-success">
                    {{ $p->panjang_m * $p->lebar_m }} m²
                </span>
            </p>
            <p>
                <strong>GeoJSON:</strong>
                <span class="d-block small text-muted">
                    {{ Str::limit($p->geojson, 300) ?? 'Belum ada data koordinat.' }}
                </span>
            </p>
        </div>
    </div>

</div>
@endforeach

</div>
</section>
</div>

{{-- FEATHER --}}
<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace()</script>
@endsection
