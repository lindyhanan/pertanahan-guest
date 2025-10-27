@extends('layouts.pertanahan.app')

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

                <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
                    <a href="{{ route('warga.create') }}" class="btn rounded-pill d-flex align-items-center gap-1 px-3"
                        style="background-color:#388e3c; color:white;">
                        <i data-feather="user-plus"></i> <span>Tambah Warga</span>
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="btn btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
                        <i data-feather="arrow-left"></i> <span>Kembali</span>
                    </a>
                </div>


                {{-- FORM TAMBAH WARGA --}}
                <div class="card border-0 shadow-sm mb-5 rounded-3" style="background-color:#f8f9f8;">
                    <div class="card-header d-flex align-items-center gap-2" style="background-color:#2e7d32; color:white;">
                        <i data-feather="user-plus"></i>
                        <h6 class="mb-0 fw-semibold">Tambah Data Warga</h6>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('warga.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                {{-- Field Form --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-secondary">Nomor KTP</label>
                                    <input type="text" name="no_ktp" maxlength="16"
                                        class="form-control border-success-subtle" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                                    <input type="text" name="nama" maxlength="50"
                                        class="form-control border-success-subtle" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-secondary">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select border-success-subtle" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-secondary">Agama</label>
                                    <input type="text" name="agama" class="form-control border-success-subtle"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-secondary">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control border-success-subtle"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-secondary">Nomor Telepon</label>
                                    <input type="text" name="telp" class="form-control border-success-subtle"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-secondary">Email</label>
                                    <input type="email" name="email" class="form-control border-success-subtle"
                                        required>
                                </div>
                            </div>

                            {{-- TOMBOL CRUD --}}
                            <div class="text-end mt-3 d-flex justify-content-end gap-2">
                                <button type="reset"
                                    class="btn btn-outline-secondary rounded-pill d-flex align-items-center gap-1 px-3">
                                    <i data-feather="rotate-ccw"></i> <span>Reset</span>
                                </button>
                                <button type="submit" class="btn rounded-pill d-flex align-items-center gap-1 px-4"
                                    style="background-color:#388e3c; color:white;">
                                    <i data-feather="save"></i> <span>Simpan Data</span>
                                </button>

                            </div>
                        </form>
                    </div>
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
                                    <p class="text-muted small mb-1"><i data-feather="phone"
                                            class="me-2 text-secondary"></i>{{ $item->telp }}</p>
                                    <p class="text-muted small mb-3"><i data-feather="mail"
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
