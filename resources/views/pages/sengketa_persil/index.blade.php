@extends('layouts.guest.app')
@section('content')
<div class="content-wrapper py-4">
    <section class="content">
        <div class="container-fluid">
            {{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-success">⚖️ Data Sengketa Persil</h4>

    <div class="d-flex gap-2">
        <a href="{{ route('sengketa_persil.create') }}"
           class="btn rounded-pill px-3"
           style="background:#388e3c;color:white;">
            <i data-feather="plus"></i> Tambah Sengketa
        </a>

        <a href="{{ route('dashboard.index') }}"
           class="btn btn-outline-success rounded-pill px-3">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </div>
</div>


            {{-- === FILTER & PENCARIAN === --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
    <div class="card-body py-3">

        <form method="GET"
              action="{{ route('sengketa_persil.index') }}">

            <div class="row g-2 align-items-center">

                {{-- KIRI: SEARCH --}}
                <div class="col-md-8">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari pihak atau kode persil..."
                           value="{{ request('search') }}">
                </div>

                {{-- KANAN: BUTTON --}}
                <div class="col-md-4 d-flex justify-content-end gap-2">
                    <button class="btn btn-success px-4 d-flex align-items-center gap-1">
                        <i data-feather="search" width="16"></i>
                        Cari
                    </button>

                    <a href="{{ route('sengketa_persil.index') }}"
                       class="btn btn-outline-secondary px-3">
                        Reset
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>




            {{-- === GRID CARD SENGKETA === --}}
            <div class="row">
                @forelse ($sengketa as $s)
                    <div class="col-md-6 col-lg-4 mb-4">
    <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius:12px;">

        {{-- ================= GAMBAR PALING ATAS ================= --}}
        @php
    $images = $s->media->filter(fn($m) =>
        Str::startsWith($m->mime_type, 'image')
    );

    $filesCount = $s->media->count();
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

    @elseif ($filesCount)
        <div class="card-image-placeholder pdf-cover">
            <i data-feather="file-text"></i>
            <span>{{ $filesCount }} File</span>
        </div>

    @else
        <div class="card-image-placeholder">
            <i data-feather="image"></i>
            <span>Belum upload bukti</span>
        </div>
    @endif
</div>



        {{-- ================= HEADER HIJAU ================= --}}
        <div class="card-header d-flex align-items-center gap-2 text-white border-0 py-3"
     style="background:#2e7d32;">
    <i data-feather="map-pin" width="18"></i>
    <h6 class="mb-0 fw-bold text-truncate">
        Sengketa Persil #{{ $s->persil->kode_persil ?? '-' }}
    </h6>
</div>


        {{-- ================= BODY ================= --}}
        <div class="card-body" style="background:#fcfdfc;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <span class="badge rounded-pill px-2 py-1
                    {{ $s->status === 'selesai' ? 'bg-success' : 'bg-warning text-dark' }}"
                    style="font-size:10px;">
                    {{ strtoupper($s->status) }}
                </span>

                <small class="text-muted font-monospace">#{{ $s->sengketa_id }}</small>
            </div>

            <div class="mb-3">
                <div class="small text-secondary">Pihak Terkait:</div>
                <div class="fw-bold text-dark d-flex align-items-center gap-2">
                    <i data-feather="users" width="14" class="text-success"></i>
                    {{ $s->pihak_1 }}
                    <span class="text-danger fw-bold">VS</span>
                    {{ $s->pihak_2 }}
                </div>
            </div>

            <div class="bg-light p-2 rounded border-start border-4 border-success">
                <small class="text-secondary d-block">Kronologi Singkat:</small>
                <p class="small mb-0 text-dark">
                    {{ \Illuminate\Support\Str::limit($s->kronologi, 70) }}
                </p>
            </div>
        </div>

        {{-- ================= FOOTER ================= --}}
        <div class="card-footer bg-white d-flex justify-content-end gap-2 border-0 py-3 mt-auto">
            <a href="#detail-sengketa-{{ $s->sengketa_id }}"
               class="btn btn-sm btn-info text-white rounded-pill px-3">
                <i data-feather="eye" width="14"></i> Detail
            </a>

            <a href="{{ route('sengketa_persil.edit', $s->sengketa_id) }}"
               class="btn btn-sm btn-warning rounded-pill px-3">
                <i data-feather="edit" width="14"></i> Edit
            </a>

            <form action="{{ route('sengketa_persil.destroy', $s->sengketa_id) }}"
                  method="POST"
                  onsubmit="return confirm('Hapus data sengketa ini?')">
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
                        <div class="opacity-25 mb-3 text-success">
                            <i data-feather="check-circle" width="64" height="64"></i>
                        </div>
                        <h5 class="text-muted">Aman! Tidak ada data sengketa.</h5>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
</div>

{{-- ================= DETAIL OVERLAY SENGKETA ================= --}}
@foreach ($sengketa as $s)
<div id="detail-sengketa-{{ $s->sengketa_id }}" class="detail-overlay">
    <div class="detail-box">

        <div class="detail-header">
            <h5>Detail Sengketa Persil #{{ $s->persil->kode_persil ?? '-' }}</h5>
            <a href="#" class="close-btn">✕</a>
        </div>

        <div class="detail-body">

            @php
                $images = $s->media->filter(fn($m) =>
                    Str::startsWith($m->mime_type, 'image')
                );

                $files = $s->media;
            @endphp

            {{-- ================= TIDAK ADA FILE ================= --}}
            @if ($files->isEmpty())
                <p class="text-muted small">Belum ada file bukti.</p>

            @else

                {{-- ================= GAMBAR ================= --}}
                @if ($images->count() === 1)
                    @php $img = $images->first(); @endphp

                    <div class="detail-image-single detail-image-wrap">
                        <img src="{{ asset('storage/'.$img->file_url) }}"
                             class="detail-image-large">

                        {{-- HAPUS --}}
                        <form action="{{ route('sengketa_persil.media.destroy', [
                                'sengketa' => $s->sengketa_id,
                                'media'   => $img->media_id
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

                                <div class="image-action-overlay">

                                    {{-- PREVIEW --}}
                                    <a href="{{ asset('storage/'.$img->file_url) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-light d-flex align-items-center gap-1">
                                        <i data-feather="eye"></i>
                                        Preview
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('sengketa_persil.media.destroy', [
                                            'sengketa' => $s->sengketa_id,
                                            'media'   => $img->media_id
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

                {{-- ================= FILE NON GAMBAR ================= --}}
                @php
                    $nonImages = $files->filter(fn($m) =>
                        !Str::startsWith($m->mime_type, 'image')
                    );
                @endphp

                @if ($nonImages->count())
                    <div class="mt-3">
                        <h6 class="fw-semibold mb-2">File Bukti Dokumen</h6>

                        @foreach ($nonImages as $file)
                            <div class="detail-image-wrap border rounded p-3
                                        d-flex align-items-center gap-2">

                                <i data-feather="file-text"></i>

                                <a href="{{ asset('storage/'.$file->file_url) }}"
                                   target="_blank"
                                   class="fw-semibold text-decoration-none">
                                    {{ basename($file->file_url) }}
                                </a>

                                <div class="image-action-overlay">

                                    <a href="{{ asset('storage/'.$file->file_url) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-light">
                                        <i data-feather="eye"></i>
                                    </a>

                                    <form action="{{ route('sengketa_persil.media.destroy', [
                                            'sengketa' => $s->sengketa_id,
                                            'media'   => $file->media_id
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

            <p><strong>Kode Persil:</strong> #{{ $s->persil->kode_persil }}</p>
            <p><strong>Status:</strong>
                <span class="badge {{ $s->status === 'selesai' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ strtoupper($s->status) }}
                </span>
            </p>
            <p><strong>Pihak 1:</strong> {{ $s->pihak_1 }}</p>
            <p><strong>Pihak 2:</strong> {{ $s->pihak_2 }}</p>

            <p><strong>Kronologi:</strong></p>
            <div class="p-2 bg-light rounded small" style="white-space:pre-line;">
                {{ $s->kronologi }}
            </div>

            <p class="mt-3"><strong>Penyelesaian:</strong></p>
            <div class="p-2 bg-success bg-opacity-10 rounded small">
                {{ $s->penyelesaian ?? 'Belum ada penyelesaian.' }}
            </div>

        </div>
    </div>
</div>
@endforeach

{{-- Script Ikon Feather --}}
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>
@endsection
