@extends('layouts.guest.app')

@section('content')
    <div class="content-wrapper py-4">
        <section class="content">
            <div class="container-fluid">

                {{-- ALERT FLASH MESSAGE --}}
                @if (session('success'))
                    <div
                        class="alert alert-success alert-dismissible fade show mt-2 shadow-sm border-0 d-flex align-items-center gap-2">
                        <i data-feather="check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="alert alert-danger alert-dismissible fade show mt-2 shadow-sm border-0 d-flex align-items-center gap-2">
                        <i data-feather="x-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Tombol Aksi & Judul Halaman --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-success">🏡 Data Persil Tanah</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('persil.create') }}" class="btn rounded-pill d-flex align-items-center gap-1 px-3"
                            style="background-color:#388e3c; color:white;">
                            <i data-feather="plus"></i> <span>Tambah Persil</span>
                        </a>
                        <a href="{{ route('dashboard') }}"
                            class="btn btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
                            <i data-feather="arrow-left"></i> <span>Kembali</span>
                        </a>
                    </div>
                </div>

                {{-- GRID UNTUK CARD PERSIL --}}
                <div class="row">
                    @forelse($persil as $p)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card border-0 shadow h-100">
                                {{-- Header Card (Kode Persil) --}}
                                <div class="card-header d-flex align-items-center gap-2"
                                    style="background-color:#2e7d32; color:white;">
                                    <i data-feather="map-pin"></i>
                                    <h6 class="mb-0 fw-semibold">PERSIL #{{ $p->kode_persil }}</h6>
                                </div>

                                {{-- Body Card (Detail Data) --}}
                                <div class="card-body" style="background-color:#f8f9f8;">
                                    <p class="card-text mb-2">
                                        <strong class="text-secondary">Pemilik (ID Warga):</strong>
                                        <span class="d-block">{{ $p->pemilik_warga_id }}</span>
                                    </p>
                                    <p class="card-text mb-2">
                                        <strong class="text-secondary">Luas Lahan:</strong>
                                        <span
                                            class="d-block fw-bold text-success">{{ number_format($p->luas_m2, 0, ',', '.') }}
                                            m²</span>
                                    </p>
                                    <p class="card-text mb-3">
                                        <strong class="text-secondary">Alamat Lahan:</strong>
                                        <span class="d-block">{{ $p->alamat_lahan }}</span>
                                    </p>
                                </div>

                                {{-- Footer Card (Aksi) --}}
                                <div class="card-footer bg-white d-flex justify-content-end gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('persil.edit', $p->persil_id) }}"
                                        class="btn btn-sm btn-warning rounded-pill px-3">
                                        <i data-feather="edit" style="width: 14px; height: 14px;"></i> Edit
                                    </a>
                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('persil.destroy', $p->persil_id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Hapus persil {{ $p->kode_persil }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                            <i data-feather="trash-2" style="width: 14px; height: 14px;"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Jika Data Kosong --}}
                        <div class="col-12 text-center py-5">
                            <div class="card p-5 shadow-sm">
                                <i data-feather="info" class="text-muted mx-auto mb-3"
                                    style="width: 30px; height: 30px;"></i>
                                <p class="mb-0 text-muted">Belum ada data persil yang tercatat.</p>
                                <a href="{{ route('persil.create') }}"
                                    class="mt-3 mx-auto btn btn-success rounded-pill px-4">
                                    Tambahkan Persil Pertama
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
                {{-- END GRID --}}

            </div>
        </section>
    </div>

    {{-- PASTIKAN SCRIPT INI ADA UNTUK ICON FEATHER --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
@endsection
