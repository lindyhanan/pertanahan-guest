@extends('layouts.guest.app')

@section('content')
<style>
    /* CSS Detail Overlay */
    .detail-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6);
        z-index: 9999;
        backdrop-filter: blur(5px);
    }
    .detail-overlay:target { display: flex; align-items: center; justify-content: center; }
    .detail-box {
        background: white; padding: 25px; border-radius: 15px;
        width: 90%; max-width: 600px; position: relative;
    }
    .detail-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px; }
    .detail-header h5 { margin: 0; color: #2e7d32; font-weight: bold; }
    .close-btn { text-decoration: none; color: #333; font-size: 20px; font-weight: bold; }
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }

    /* Card image */
    .card-img-container { height: 180px; overflow: hidden; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; }
    .card-img-container img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
    .card:hover .card-img-container img { transform: scale(1.05); }
</style>

<div class="content-wrapper py-4">
    <section class="content">
        <div class="container-fluid">

            {{-- Filter --}}
            <form method="GET" action="{{ route('peta_persil.index') }}" class="mb-4 row g-2 align-items-center">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control shadow-sm" placeholder="Cari nama persil..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-success shadow-sm px-4">Cari</button>
                    <a href="{{ route('peta_persil.index') }}" class="btn btn-outline-secondary shadow-sm px-3">Reset</a>
                </div>
            </form>

            {{-- Tombol aksi --}}
            <div class="d-flex justify-content-end mb-4 gap-2">
                <a href="{{ route('peta_persil.create') }}" class="btn rounded-pill px-4 shadow-sm d-flex align-items-center gap-2" style="background:#388e3c; color:white; font-weight:bold; border:none;">
                    <i data-feather="plus" width="18"></i> Tambah Peta Baru
                </a>
                <a href="{{ route('dashboard.index') }}" class="btn btn-outline-success rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
                    <i data-feather="arrow-left" width="18"></i> Kembali
                </a>
            </div>

            {{-- Grid Card --}}
            <div class="row">
                @forelse ($peta as $item)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 12px;">
                            {{-- Header --}}
                            <div class="card-header d-flex align-items-center gap-2 text-white border-0 py-3" style="background:#2e7d32;">
                                <i data-feather="map" width="18"></i>
                                <h6 class="mb-0 fw-bold text-truncate">{{ $item->persil->nama ?? 'Persil Tak Bernama' }}</h6>
                            </div>

                            {{-- Foto / preview --}}
                            <div class="card-img-container">
                                @php $foto = $item->media->first(); @endphp
                                @if($foto)
                                    <img src="{{ asset('storage/'.$foto->file_url) }}" alt="Foto Peta">
                                @else
                                    <div class="text-center text-muted opacity-25">
                                        <i data-feather="image" width="48" height="48"></i>
                                        <small>Tidak ada foto</small>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 end-0 m-2 bg-dark bg-opacity-50 text-white px-2 py-1 rounded small">
                                    #{{ $item->peta_id }}
                                </div>
                            </div>

                            {{-- Body --}}
                            <div class="card-body border-bottom" style="background:#fcfdfc;">
                                <div class="row text-center">
                                    <div class="col-6 border-end">
                                        <small class="text-secondary d-block">Panjang</small>
                                        <span class="fw-bold text-dark">{{ $item->panjang_m }} m</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-secondary d-block">Lebar</small>
                                        <span class="fw-bold text-dark">{{ $item->lebar_m }} m</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="card-footer bg-white d-flex justify-content-center gap-2 border-0 py-3">
                                <a href="#detail-peta-{{ $item->peta_id }}" class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm">
                                    <i data-feather="eye" width="14"></i> Detail
                                </a>
                                <a href="{{ route('peta_persil.edit', $item->peta_id) }}" class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm">
                                    <i data-feather="edit" width="14"></i> Edit
                                </a>
                                <form action="{{ route('peta_persil.destroy', $item->peta_id) }}" method="POST" onsubmit="return confirm('Hapus data peta ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm">
                                        <i data-feather="trash-2" width="14"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="opacity-25 mb-3"><i data-feather="map-pin" width="64" height="64"></i></div>
                        <h5 class="text-muted">Data peta belum tersedia.</h5>
                        <p class="text-secondary">Silakan klik tombol "Tambah Peta Baru" untuk mulai mengisi data.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>

{{-- Detail overlay --}}
@foreach ($peta as $item)
<div id="detail-peta-{{ $item->peta_id }}" class="detail-overlay">
    <div class="detail-box shadow-lg">
        <div class="detail-header">
            <h5>Detail Informasi Peta</h5>
            <a href="#" class="close-btn">✕</a>
        </div>
        <div class="detail-body">
            <div class="detail-grid">
                <div class="p-2 border-bottom">
                    <small class="text-secondary">Nama Persil</small>
                    <div class="fw-bold text-success">{{ $item->persil->nama ?? '-' }}</div>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary">Kode Peta</small>
                    <div class="fw-bold">PETA-{{ $item->peta_id }}</div>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary">Dimensi Fisik</small>
                    <div class="fw-bold">{{ $item->panjang_m }}m x {{ $item->lebar_m }}m</div>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary">Estimasi Luas</small>
                    <div class="fw-bold text-primary">{{ $item->panjang_m * $item->lebar_m }} m²</div>
                </div>
                <div class="col-span-full p-2" style="grid-column: 1 / -1;">
                    <small class="text-secondary">Data GeoJSON (Spasial)</small>
                    <div class="p-2 mt-1 bg-light border rounded font-monospace" style="font-size: 11px; word-break: break-all; max-height: 100px; overflow-y: auto;">
                        {{ $item->geojson ?? 'Data koordinat belum diinputkan.' }}
                    </div>
                </div>
            </div>

            {{-- Media --}}
            @if($item->media->count() > 0)
            <div class="mt-4 p-2">
                <small class="text-secondary d-block mb-2">Lampiran File Terkait:</small>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($item->media as $m)
                        <a href="{{ asset('storage/'.$m->file_url) }}" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center gap-2 rounded-pill px-3">
                            <i data-feather="file-text" width="14"></i> Lihat Dokumen
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-secondary btn-sm px-4 rounded-pill">Tutup Detail</a>
        </div>
    </div>
</div>
@endforeach

{{-- Feather icons --}}
<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace();</script>
@endsection
