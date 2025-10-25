@extends('layouts.pertanahan.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-clipboard-list me-2"></i> Data Penggunaan Lahan</h4>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- ALERT FLASH MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ===== FORM TAMBAH PENGGUNAAN ===== --}}
            <div class="card border-0 shadow-sm mb-4 mt-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Tambah Data Penggunaan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('penggunaan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Penggunaan</label>
                                <input type="text" name="nama_penggunaan" class="form-control" placeholder="Contoh: Permukiman" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Area tempat tinggal warga" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ===== LIST DATA PENGGUNAAN (KARTU) ===== --}}
            <div class="row">
                @forelse($data_penggunaan as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100 hover-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                        <i class="fas fa-tree fa-lg"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0 text-primary">{{ $item->nama_penggunaan }}</h5>
                                        <small class="text-muted">#{{ $item->jenis_id }}</small>
                                    </div>
                                </div>
                                <p class="text-muted">{{ $item->keterangan }}</p>

                                {{-- Optional: rating dummy --}}
                                <div class="mb-3">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('penggunaan.edit', $item->jenis_id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('penggunaan.destroy', $item->jenis_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted mt-4">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>Belum ada data penggunaan lahan.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
</div>

{{-- Sedikit gaya tambahan agar kartu tampil lebih interaktif --}}
<style>
.hover-card:hover {
    transform: translateY(-5px);
    transition: all 0.2s ease-in-out;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}
</style>
@endsection
