@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
    <section class="content">
        <div class="container-fluid">

            {{-- Flash --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-success">
                    Detail Persil - {{ $persil->kode_persil }}
                </h4>
                <div>
                    <a href="{{ route('persil.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">

                        {{-- Kiri: Detail Persil --}}
                        <div class="col-md-6">
                            <p><strong>Pemilik (ID Warga):</strong> {{ $persil->pemilik_warga_id }}</p>
                            <p><strong>Luas (m²):</strong> {{ number_format($persil->luas_m2, 2, ',', '.') }}</p>
                            <p><strong>Penggunaan:</strong> {{ $persil->penggunaan ?? '-' }}</p>
                            <p><strong>Alamat:</strong> {{ $persil->alamat_lahan }}</p>
                            <p><strong>RT/RW:</strong> {{ $persil->rt }} / {{ $persil->rw }}</p>
                        </div>

                        {{-- Kanan: Media / Foto --}}
                        <div class="col-md-6">
                            <h6>Foto Bidang / Koordinat</h6>

                            @if ($persil->media && $persil->media->count())
                                <div class="row g-2">
                                    @foreach ($persil->media as $m)
                                        <div class="col-6 col-md-4 mb-3">
                                            <div class="card">

                                                @php
                                                    $isImage = str_contains($m->mime_type, 'image');
                                                @endphp

                                                {{-- Preview Image / File --}}
                                                @if ($isImage)
                                                    <img src="{{ Storage::url($m->file_url) }}"
                                                         class="card-img-top"
                                                         alt="Media">
                                                @else
                                                    <div class="p-3 text-center">
                                                        <i class="bi bi-file-earmark-text" style="font-size: 40px;"></i>
                                                        <p class="small mt-2">
                                                            {{ strtoupper(pathinfo($m->file_url, PATHINFO_EXTENSION)) }}
                                                        </p>
                                                        <a href="{{ Storage::url($m->file_url) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-primary">
                                                            Download
                                                        </a>
                                                    </div>
                                                @endif

                                                {{-- Caption + Action --}}
                                                <div class="card-body p-2">
                                                    <small class="d-block text-truncate mb-2">
                                                        {{ $m->caption ?? '' }}
                                                    </small>

                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ Storage::url($m->file_url) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-primary">
                                                           Lihat
                                                        </a>

                                                        <form action="{{ route('persil.media.destroy', [$persil->persil_id, $m->media_id]) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Hapus foto ini?')">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger" type="submit">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-muted">Belum ada foto terkait persil ini.</div>
                            @endif

                        </div> {{-- END col-md-6 --}}

                    </div> {{-- END row --}}
                </div>
            </div>

        </div>
    </section>
</div>

{{-- Feather Icons --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endsection
