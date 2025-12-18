@extends('layouts.guest.app')

@section('content')
<style>
    /* Overlay Detail */
    .detail-overlay { display: none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.6); z-index:9999; backdrop-filter: blur(5px); justify-content:center; align-items:center; }
    .detail-overlay:target { display: flex; }
    .detail-box { background: white; padding:25px; border-radius:15px; width:90%; max-width:600px; position: relative; }
    .detail-header { display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #eee; padding-bottom:10px; margin-bottom:15px; }
    .detail-header h5 { margin:0; color:#2e7d32; font-weight:bold; }
    .close-btn { text-decoration:none; color:#333; font-size:20px; font-weight:bold; }
    .detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:15px; }

    /* Card Image */
    .card-img-container { height:200px; overflow:hidden; background-color:#f0f0f0; display:flex; align-items:center; justify-content:center; }
    .card-img-container img { width:100%; height:100%; object-fit:cover; transition: transform 0.3s ease; }
    .card:hover .card-img-container img { transform: scale(1.1); }
</style>

<div class="content-wrapper py-4">
    <section class="content">
        <div class="container-fluid">

            {{-- FILTER & PENCARIAN --}}
            <form method="GET" action="{{ route('dokumen_persil.index') }}" class="mb-4 row g-2 align-items-center">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control shadow-sm"
                        placeholder="Cari nama persil atau nomor dokumen..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-success shadow-sm px-4">Cari</button>
                    <a href="{{ route('dokumen_persil.index') }}" class="btn btn-outline-secondary shadow-sm px-3">Reset</a>
                </div>
            </form>

            {{-- TOMBOL AKSI --}}
            <div class="d-flex justify-content-end mb-4 gap-2">
                <a href="{{ route('dokumen_persil.create') }}"
                   class="btn rounded-pill px-4 shadow-sm d-flex align-items-center gap-2"
                   style="background:#388e3c; color:white; font-weight:bold; border:none;">
                    <i data-feather="plus" width="18"></i> Tambah Dokumen
                </a>
                <a href="{{ route('dashboard.index') }}"
                   class="btn btn-outline-success rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
                    <i data-feather="arrow-left" width="18"></i> Kembali
                </a>
            </div>

            {{-- GRID CARD DOKUMEN --}}
            <div class="row">
                @forelse ($dokumens as $dok)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius:12px;">
                            {{-- HEADER CARD --}}
                            <div class="card-header d-flex align-items-center gap-2 text-white border-0 py-3"
                                 style="background:#2e7d32;">
                                <i data-feather="file-text" width="18"></i>
                                <h6 class="mb-0 fw-bold text-truncate">
                                    {{ $dok->persil->nama ?? 'Persil Tak Bernama' }}
                                </h6>
                            </div>

                            {{-- FOTO THUMBNAIL --}}
                            <div class="card-img-container">
                                @php $foto = $dok->media->first(); @endphp
                                @if($foto)
                                    <img src="{{ Storage::url($foto->file_path) }}" alt="Foto Dokumen">
                                @else
                                    <div class="text-center text-muted opacity-50">
                                        <i data-feather="image" width="48" height="48"></i>
                                        <p class="small mb-0">Tidak ada foto</p>
                                    </div>
                                @endif
                            </div>

                            {{-- BODY CARD --}}
                            <div class="card-body" style="background:#fcfdfc;">
                                <div class="mb-2">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 uppercase tracking-wider" style="font-size:10px;">
                                        {{ $dok->jenis_dokumen }}
                                    </span>
                                    <small class="text-muted float-end">#{{ $dok->dokumen_id }}</small>
                                </div>
                                <h5 class="text-dark fw-bold mb-1" style="font-size:1rem;">
                                    {{ $dok->nomor }}
                                </h5>
                                <p class="text-muted small mb-0">
                                    {{ Str::limit($dok->keterangan ?? 'Tidak ada keterangan tambahan.', 85) }}
                                </p>
                            </div>

                            {{-- FOOTER CARD --}}
                            <div class="card-footer bg-white d-flex justify-content-end gap-2 border-0 pb-3">
                                <a href="#detail-dok-{{ $dok->dokumen_id }}"
                                   class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm">
                                    <i data-feather="eye" width="14"></i> Detail
                                </a>
                                <a href="{{ route('dokumen_persil.edit', $dok->dokumen_id) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm">
                                    <i data-feather="edit" width="14"></i> Edit
                                </a>
                                <form action="{{ route('dokumen_persil.destroy', $dok->dokumen_id) }}"
                                      method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
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
                        <div class="opacity-25 mb-3 text-success">
                            <i data-feather="folder-plus" width="64" height="64"></i>
                        </div>
                        <h5 class="text-muted">Data dokumen belum tersedia.</h5>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
</div>

{{-- DETAIL OVERLAY --}}
@foreach ($dokumens as $dok)
<div id="detail-dok-{{ $dok->dokumen_id }}" class="detail-overlay">
    <div class="detail-box shadow-lg">
        <div class="detail-header">
            <h5>Detail Arsip Dokumen</h5>
            <a href="#!" class="close-btn">✕</a>
        </div>
        <div class="detail-body" style="max-height:70vh; overflow-y:auto;">
            {{-- Semua Foto --}}
            @foreach($dok->media as $m)
                <div class="mb-4 rounded-lg overflow-hidden border">
                    <img src="{{ Storage::url($m->file_path) }}" class="img-fluid w-100" alt="Detail Foto">
                </div>
            @endforeach

            <div class="detail-grid">
                <div class="p-2 border-bottom">
                    <small class="text-secondary">Nama Persil</small>
                    <div class="fw-bold text-success">{{ $dok->persil->nama ?? '-' }}</div>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary">Jenis Dokumen</small>
                    <div class="fw-bold">{{ $dok->jenis_dokumen }}</div>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary">Nomor Dokumen</small>
                    <div class="fw-bold">{{ $dok->nomor }}</div>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary">Tanggal Input</small>
                    <div class="fw-bold">{{ $dok->created_at->format('d M Y') }}</div>
                </div>
                <div class="col-span-full p-2" style="grid-column:1/-1;">
                    <small class="text-secondary">Keterangan Tambahan</small>
                    <div class="p-2 mt-1 bg-light border rounded italic small">
                        {{ $dok->keterangan ?? 'Tidak ada deskripsi.' }}
                    </div>
                </div>
            </div>

            <div class="mt-4 p-2">
                <small class="text-secondary d-block mb-2 font-bold">Semua File Terlampir:</small>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($dok->media as $m)
                        <a href="{{ Storage::url($m->file_path) }}" target="_blank"
                           class="btn btn-outline-dark btn-sm d-flex align-items-center gap-2 rounded-pill px-3">
                            <i data-feather="download" width="14"></i> Unduh/Lihat Berkas
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="text-center mt-4 pt-3 border-top">
            <a href="#!" class="btn btn-secondary btn-sm px-4 rounded-pill">Tutup</a>
        </div>
    </div>
</div>
@endforeach

<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace();</script>
@endsection
