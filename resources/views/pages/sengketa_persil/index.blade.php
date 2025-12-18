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
        width: 90%; max-width: 650px; position: relative;
    }
    .detail-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px; }
    .detail-header h5 { margin: 0; color: #d32f2f; font-weight: bold; } /* Warna merah dikit karena sengketa */
    .close-btn { text-decoration: none; color: #333; font-size: 20px; font-weight: bold; }
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
</style>

<div class="content-wrapper py-4">
    <section class="content">
        <div class="container-fluid">

            {{-- === FILTER & PENCARIAN === --}}
            <form method="GET" action="{{ route('sengketa_persil.index') }}" class="mb-4 row g-2 align-items-center">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control shadow-sm"
                           placeholder="Cari pihak atau persil..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-success shadow-sm px-4">Cari</button>
                    <a href="{{ route('sengketa_persil.index') }}" class="btn btn-outline-secondary shadow-sm px-3">Reset</a>
                </div>
            </form>

            {{-- === TOMBOL AKSI (HIJAU EMERALD) === --}}
            <div class="d-flex justify-content-end mb-4 gap-2">
                <a href="{{ route('sengketa_persil.create') }}"
                   class="btn rounded-pill px-4 shadow-sm d-flex align-items-center gap-2"
                   style="background:#388e3c; color:white; font-weight:bold; border:none;">
                    <i data-feather="alert-circle" width="18"></i> Tambah Sengketa
                </a>
                <a href="{{ route('dashboard.index') }}"
                   class="btn btn-outline-success rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
                    <i data-feather="arrow-left" width="18"></i> Kembali
                </a>
            </div>

            {{-- === GRID CARD SENGKETA === --}}
            <div class="row">
                @forelse ($sengketa as $s)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 12px;">

                            {{-- HEADER CARD (Emerald) --}}
                            <div class="card-header d-flex align-items-center gap-2 text-white border-0 py-3"
                                 style="background:#2e7d32;">
                                <i data-feather="shield-off" width="18"></i>
                                <h6 class="mb-0 fw-bold text-truncate">
                                    {{ $s->persil->nama ?? 'Persil Tak Bernama' }}
                                </h6>
                            </div>

                            {{-- BODY CARD --}}
                            <div class="card-body" style="background:#fcfdfc;">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge rounded-pill px-2 py-1 {{ $s->status == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }}" style="font-size: 10px;">
                                        {{ strtoupper($s->status) }}
                                    </span>
                                    <small class="text-muted font-monospace">#{{ $s->sengketa_id }}</small>
                                </div>

                                <div class="mb-3">
                                    <div class="small text-secondary">Pihak Terkait:</div>
                                    <div class="fw-bold text-dark d-flex align-items-center gap-2">
                                        <i data-feather="users" width="14" class="text-success"></i>
                                        {{ $s->pihak_1 }} <span class="text-danger small font-bold">VS</span> {{ $s->pihak_2 }}
                                    </div>
                                </div>

                                <div class="bg-light p-2 rounded border-start border-4 border-success mb-0">
                                    <small class="text-secondary d-block">Kronologi Singkat:</small>
                                    <p class="small mb-0 text-dark italic">
                                        {{ Str::limit($s->kronologi, 70) }}
                                    </p>
                                </div>
                            </div>

                            {{-- FOOTER CARD --}}
                            <div class="card-footer bg-white d-flex justify-content-end gap-2 border-0 pb-3 mt-auto">
                                <a href="#detail-sengketa-{{ $s->sengketa_id }}"
                                   class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm">
                                    <i data-feather="eye" width="14"></i> Detail
                                </a>
                                <a href="{{ route('sengketa_persil.edit', $s->sengketa_id) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm">
                                    <i data-feather="edit" width="14"></i> Edit
                                </a>
                                <form action="{{ route('sengketa_persil.destroy', $s->sengketa_id) }}"
                                      method="POST" onsubmit="return confirm('Hapus data sengketa ini?')">
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
                            <i data-feather="check-circle" width="64" height="64"></i>
                        </div>
                        <h5 class="text-muted">Aman! Tidak ada data sengketa.</h5>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
</div>

{{-- === DETAIL OVERLAY (MODAL) === --}}
@foreach ($sengketa as $s)
<div id="detail-sengketa-{{ $s->sengketa_id }}" class="detail-overlay">
    <div class="detail-box shadow-lg">
        <div class="detail-header">
            <h5><i data-feather="file-text" class="me-2"></i>Detail Sengketa Lahan</h5>
            <a href="#" class="close-btn">✕</a>
        </div>
        <div class="detail-body">
            <div class="detail-grid">
                <div class="p-2 border-bottom">
                    <small class="text-secondary d-block">Nama Persil</small>
                    <span class="fw-bold text-success">{{ $s->persil->nama ?? '-' }}</span>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary d-block">Status Kasus</small>
                    <span class="badge bg-dark">{{ $s->status }}</span>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary d-block">Pihak Pertama</small>
                    <span class="fw-bold">{{ $s->pihak_1 }}</span>
                </div>
                <div class="p-2 border-bottom">
                    <small class="text-secondary d-block">Pihak Kedua</small>
                    <span class="fw-bold">{{ $s->pihak_2 }}</span>
                </div>
                <div class="col-span-full p-2 border-bottom" style="grid-column: 1 / -1;">
                    <small class="text-secondary d-block">Kronologi Lengkap</small>
                    <div class="mt-1 small text-dark" style="text-align: justify; white-space: pre-line;">
                        {{ $s->kronologi }}
                    </div>
                </div>
                <div class="col-span-full p-2 bg-success bg-opacity-10 rounded" style="grid-column: 1 / -1;">
                    <small class="text-success fw-bold d-block">Hasil Penyelesaian</small>
                    <div class="mt-1 small">
                        {{ $s->penyelesaian ?? 'Belum ada penyelesaian resmi.' }}
                    </div>
                </div>
            </div>

            {{-- Bagian Bukti/Media --}}
            <div class="mt-4 p-2">
                <small class="text-secondary d-block mb-2 font-bold">Bukti Pendukung (Media):</small>
                <div class="d-flex flex-wrap gap-2">
                    @forelse($s->media as $m)
                        <a href="{{ asset('storage/'.$m->file_path) }}" target="_blank"
                           class="btn btn-outline-dark btn-sm d-flex align-items-center gap-2 rounded-pill px-3">
                             <i data-feather="paperclip" width="14"></i> Lihat Bukti
                        </a>
                    @empty
                        <span class="text-muted small italic">Tidak ada bukti file yang diunggah.</span>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="text-center mt-4 pt-3 border-top">
            <a href="#" class="btn btn-secondary btn-sm px-4 rounded-pill">Tutup</a>
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
