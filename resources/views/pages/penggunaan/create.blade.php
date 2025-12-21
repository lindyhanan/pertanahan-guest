@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
    <section class="content">
        <div class="container-fluid">

            {{-- FLASH MESSAGE --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0
                            d-flex align-items-center gap-2 mb-4">
                    <i data-feather="check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FORM TERPUSAT --}}
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">

                    {{-- JUDUL --}}
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-success">🌿 Tambah Data Penggunaan</h2>
                        <p class="text-muted">
                            Tambahkan jenis penggunaan lahan untuk pengelompokan persil tanah.
                        </p>
                    </div>

                    <div class="card border-0 shadow-sm mb-5 rounded-3"
                         style="background:#f8f9f8;">

                        {{-- HEADER --}}
                        <div class="card-header d-flex align-items-center gap-2"
                             style="background:#2e7d32;color:white;">
                            <i data-feather="layers"></i>
                            <h6 class="mb-0 fw-semibold">Form Penggunaan Lahan</h6>
                        </div>

                        {{-- BODY --}}
                        <div class="card-body">
                            <form action="{{ route('penggunaan.store') }}" method="POST">
                                @csrf

                                {{-- ID (AUTO) --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        ID Penggunaan
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{ $nextId ?? 'Otomatis' }}"
                                           disabled>
                                </div>

                                <div class="row">
                                    {{-- NAMA --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-semibold">
                                            Nama Penggunaan <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="nama_penggunaan"
                                               class="form-control border-success-subtle"
                                               placeholder="Contoh: Permukiman"
                                               required>
                                    </div>

                                    {{-- KETERANGAN --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-semibold">
                                            Keterangan <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="keterangan"
                                               class="form-control border-success-subtle"
                                               placeholder="Contoh: Area tempat tinggal warga"
                                               required>
                                    </div>
                                </div>

                                {{-- ACTION --}}
                                <div class="text-end mt-4 pt-3 border-top
                                            d-flex justify-content-end gap-2">
                                    <a href="{{ route('penggunaan.index') }}"
                                       class="btn btn-outline-secondary rounded-pill
                                              d-flex align-items-center gap-1 px-3">
                                        <i data-feather="arrow-left"></i>
                                        Kembali
                                    </a>

                                    <button type="reset"
                                            class="btn btn-outline-secondary rounded-pill
                                                   d-flex align-items-center gap-1 px-3">
                                        <i data-feather="rotate-ccw"></i>
                                        Reset
                                    </button>

                                    <button type="submit"
                                            class="btn rounded-pill
                                                   d-flex align-items-center gap-1 px-4"
                                            style="background:#388e3c;color:white;">
                                        <i data-feather="save"></i>
                                        Simpan Data
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

{{-- FEATHER --}}
<script>
document.addEventListener('DOMContentLoaded', () => feather.replace());
</script>
@endsection
