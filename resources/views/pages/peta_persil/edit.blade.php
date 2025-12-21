@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
    <section class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">

                    {{-- Judul Halaman --}}
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-success">✍️ Edit Peta Persil</h2>
                        <p class="text-muted">
                            Perbarui data peta untuk Persil #{{ $p->persil_id }}
                        </p>
                    </div>

                    <div class="card border-0 shadow-sm mb-5 rounded-3"
                        style="background-color:#f8f9f8;">

                        {{-- Header --}}
                        <div class="card-header d-flex align-items-center gap-2"
                            style="background-color:#2e7d32; color:white;">
                            <i data-feather="map"></i>
                            <h6 class="mb-0 fw-semibold">Formulir Edit Peta Persil</h6>
                        </div>

                        {{-- Body --}}
                        <div class="card-body">
                            <form action="{{ route('peta_persil.update', $p->peta_id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    {{-- Persil ID --}}
                                    <div class="col-md-6 mb-3">
    <label class="form-label text-secondary fw-semibold">
        Persil <span class="text-danger">*</span>
    </label>

    <select name="persil_id"
             class="form-control border-success-subtle
               @error('persil_id') is-invalid @enderror"
            required>

        <option value="">-- Pilih Kode Persil --</option>

        @foreach ($persils as $persil)
            <option value="{{ $persil->persil_id }}"
                {{ old('persil_id', $p->persil_id) == $persil->persil_id ? 'selected' : '' }}>
                {{ $persil->kode_persil }}
                — {{ $persil->alamat_lahan }}
            </option>
        @endforeach

    </select>

    @error('persil_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                                </div>

                                <div class="row">
                                    {{-- Panjang --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-semibold">Panjang (m)</label>
                                        <input type="number" step="0.01" min="0" name="panjang_m"
                                            class="form-control border-success-subtle @error('panjang_m') is-invalid @enderror"
                                            value="{{ old('panjang_m', $p->panjang_m) }}">
                                        @error('panjang_m')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Lebar --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-semibold">Lebar (m)</label>
                                        <input type="number" step="0.01" min="0" name="lebar_m"
                                            class="form-control border-success-subtle @error('lebar_m') is-invalid @enderror"
                                            value="{{ old('lebar_m', $p->lebar_m) }}">
                                        @error('lebar_m')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- GeoJSON --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">GeoJSON</label>
                                    <textarea name="geojson"
                                        class="form-control border-success-subtle @error('geojson') is-invalid @enderror"
                                        rows="4">{{ old('geojson', $p->geojson) }}</textarea>
                                    @error('geojson')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Upload --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Tambah File Peta (opsional)
                                    </label>
                                    <input type="file" name="dokumen_file[]" class="form-control" multiple>

                                    <small class="text-muted">
                                        Tambah file baru tanpa menghapus file lama.
                                    </small>
                                </div>

                                {{-- File Lama --}}
                                @if($p->media->count())
                                    <div class="mb-3">
                                        <label class="form-label text-secondary fw-semibold">
                                            File Peta Saat Ini
                                        </label>
                                        @foreach($p->media as $m)
                                            <div>
                                                <a href="{{ asset('storage/'.$m->file_url) }}" target="_blank">
    {{ $m->file_url }}
</a>

                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Tombol --}}
                                <div class="text-end mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                                    <a href="{{ route('peta_persil.index') }}"
                                        class="btn btn-outline-secondary rounded-pill d-flex align-items-center gap-1 px-3">
                                        <i data-feather="x-circle"></i>
                                        <span>Batal</span>
                                    </a>
                                    <button type="submit"
                                        class="btn rounded-pill d-flex align-items-center gap-1 px-4"
                                        style="background-color:#388e3c; color:white;">
                                        <i data-feather="save"></i>
                                        <span>Update Data</span>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endsection
