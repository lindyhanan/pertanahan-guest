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
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="GET" action="{{ route('warga.index') }}" class="mb-4 row g-2 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama, pekerjaan, atau email..." value="{{ $search ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">Semua Jenis Kelamin</option>
                            <option value="Laki-laki" {{ ($jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ ($jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-success" type="submit">Terapkan</button>
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>

                <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
                    <a href="{{ route('warga.create') }}" class="btn rounded-pill d-flex align-items-center gap-1 px-3"
                        style="background-color:#388e3c; color:white;">
                        <i data-feather="user-plus"></i> <span>Tambah Warga</span>
                    </a>
                    <a href="{{ route('dashboard.index') }}"
                        class="btn btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
                        <i data-feather="arrow-left"></i> <span>Kembali</span>
                    </a>
                </div>

                {{-- LIST DATA WARGA --}}
                <div class="row">
                    @forelse($warga as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 hover-card overflow-hidden"
                                style="background-color:#f5f5f5;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3 gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                            style="width:55px; height:55px; background-color:#388e3c; color:white;">
                                            <i data-feather="user" class="fs-5"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-semibold text-success mb-0">{{ $item->nama }}</h5>
                                            <small class="text-muted">{{ $item->pekerjaan }}</small>
                                        </div>
                                    </div>

                                    <p class="text-muted small mb-1"><i data-feather="credit-card"
                                            class="me-2 text-secondary"></i>{{ $item->no_ktp }}</p>
                                    <p class="text-muted small mb-3"><i data-feather="map-pin"
                                            class="me-2 text-secondary"></i>{{ $item->alamat }}</p> {{-- ALAMAT TAMBAHAN --}}
                                    <p class="text-muted small mb-1"><i data-feather="phone"
                                            class="me-2 text-secondary"></i>{{ $item->telp }}</p>
                                    <p class="text-muted small mb-1"><i data-feather="mail"
                                            class="me-2 text-secondary"></i>{{ $item->email }}</p>

                                    <hr class="my-3">

                                    {{-- TOMBOL CRUD PER ITEM --}}
                                    <div class="d-flex justify-content-between gap-2">
                                        <a href="{{ route('warga.show', $item->warga_id) }}"
                                            class="btn btn-sm btn-outline-info rounded-pill d-flex align-items-center gap-1 px-3">
                                            <i data-feather="eye"></i> <span>Detail</span>
                                        </a>
                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                            class="btn btn-sm btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
                                            <i data-feather="edit-3"></i> <span>Edit</span>
                                        </a>
                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="btn btn-sm btn-outline-danger rounded-pill d-flex align-items-center gap-1 px-3">
                                                <i data-feather="trash-2"></i> <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5 d-flex flex-column align-items-center gap-3">
                            <i data-feather="inbox" class="fs-1"></i>
                            <p class="fs-5">Belum ada data warga.</p>
                        </div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $warga->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    </div>

    {{-- Hover card --}}
    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>

    {{-- Feather Icons --}}
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
@endsection
