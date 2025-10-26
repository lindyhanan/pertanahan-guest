@extends('layouts.pertanahan.app')

@section('content')
<div class="content-wrapper py-4">
    
    {{-- HEADER --}}
    <div class="content-header d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h4 class="fw-semibold text-success-emphasis mb-0">
            <i class="fas fa-users me-2 text-success"></i> Data Warga
        </h4>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- ALERT FLASH MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2 shadow-sm border-0">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FORM TAMBAH WARGA --}}
            <div class="card border-0 shadow-sm mb-5 rounded-3" style="background-color:#f8f9f8;">
                <div class="card-header" style="background-color:#2e7d32; color:white;">
                    <h6 class="mb-0 fw-semibold">
                        <i class="fas fa-user-plus me-2"></i> Tambah Data Warga
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('warga.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Nomor KTP</label>
                                <input type="text" name="no_ktp" maxlength="16" class="form-control border-success-subtle" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                                <input type="text" name="nama" maxlength="50" class="form-control border-success-subtle" required>
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
                                <input type="text" name="agama" class="form-control border-success-subtle" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control border-success-subtle" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Nomor Telepon</label>
                                <input type="text" name="telp" class="form-control border-success-subtle" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Email</label>
                                <input type="email" name="email" class="form-control border-success-subtle" required>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="reset" class="btn btn-outline-secondary rounded-pill me-2 px-3">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="btn rounded-pill px-4" style="background-color:#388e3c; color:white;">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- LIST DATA WARGA --}}
            <div class="row">
                @forelse($warga as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 hover-card overflow-hidden" style="background-color:#f5f5f5;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                         style="width:55px; height:55px; background-color:#388e3c; color:white;">
                                        <i class="fas fa-user fa-lg"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-semibold text-success mb-0">{{ $item->nama }}</h5>
                                        <small class="text-muted">{{ $item->pekerjaan }}</small>
                                    </div>
                                </div>

                                <p class="text-muted small mb-1"><i class="fas fa-id-card me-2 text-secondary"></i>{{ $item->no_ktp }}</p>
                                <p class="text-muted small mb-1"><i class="fas fa-phone me-2 text-secondary"></i>{{ $item->telp }}</p>
                                <p class="text-muted small mb-3"><i class="fas fa-envelope me-2 text-secondary"></i>{{ $item->email }}</p>

                                <hr class="my-3">

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('warga.edit', $item->warga_id) }}"
                                       class="btn btn-sm btn-outline-success rounded-pill px-3">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p class="fs-5">Belum ada data warga.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>

{{-- Efek hover lembut --}}
<style>
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}
</style>
@endsection
