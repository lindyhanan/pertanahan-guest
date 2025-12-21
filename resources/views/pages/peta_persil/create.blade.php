@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
    <section class="content">
        <div class="container-fluid">

            {{-- FORM TERPUSAT --}}
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">

                    {{-- JUDUL --}}
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-success">🗺️ Tambah Peta Persil</h2>
                        <p class="text-muted">
                            Masukkan informasi peta dan dimensi bidang tanah.
                        </p>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3 mb-5"
                         style="background:#f8f9f8;">

                        {{-- HEADER --}}
                        <div class="card-header d-flex align-items-center gap-2"
                             style="background:#2e7d32;color:white;">
                            <i data-feather="map"></i>
                            <h6 class="mb-0 fw-semibold">Form Peta Persil</h6>
                        </div>

                        {{-- BODY --}}
                        <div class="card-body">
                            <form action="{{ route('peta_persil.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                {{-- PERSIL --}}
                                {{-- PERSIL --}}
<div class="mb-3">
    <label class="form-label fw-semibold text-secondary">
        Persil <span class="text-danger">*</span>
    </label>

    <select name="persil_id"
             class="form-control border-success-subtle
               @error('persil_id') is-invalid @enderror"
            required>
        <option value="">-- Pilih Kode Persil --</option>

        @foreach ($persils as $persil)
            <option value="{{ $persil->persil_id }}"
                {{ old('persil_id') == $persil->persil_id ? 'selected' : '' }}>
                {{ $persil->kode_persil }} — {{ $persil->alamat_lahan }}
            </option>
        @endforeach
    </select>

    @error('persil_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


                                {{-- DIMENSI --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-secondary">
                                            Panjang (meter)
                                        </label>
                                        <input type="number"
                                               step="0.01"
                                               name="panjang_m"
                                               class="form-control border-success-subtle"
                                               value="{{ old('panjang_m') }}"
                                               placeholder="Contoh: 25.50">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold text-secondary">
                                            Lebar (meter)
                                        </label>
                                        <input type="number"
                                               step="0.01"
                                               name="lebar_m"
                                               class="form-control border-success-subtle"
                                               value="{{ old('lebar_m') }}"
                                               placeholder="Contoh: 18.75">
                                    </div>
                                </div>

                                {{-- GEOJSON --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">
                                        GeoJSON (opsional)
                                    </label>
                                    <textarea name="geojson"
                                              rows="4"
                                              class="form-control border-success-subtle"
                                              placeholder="Masukkan data koordinat (jika ada)">{{ old('geojson') }}</textarea>
                                    <small class="text-muted">
                                        Kosongkan jika belum memiliki data koordinat.
                                    </small>
                                </div>

                                {{-- UPLOAD FILE --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">
                                        Upload File Peta (opsional)
                                    </label>
                                    <input type="file"
                                           name="dokumen_file[]"
                                           multiple
                                           class="form-control"
                                           accept=".jpg,.jpeg,.png,.pdf">
                                    <small class="text-muted">
                                        Bisa upload lebih dari satu file (foto / PDF).
                                    </small>
                                </div>

                                {{-- AKSI --}}
                                <div class="text-end mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                                    <a href="{{ route('peta_persil.index') }}"
                                       class="btn btn-outline-secondary rounded-pill
                                              d-flex align-items-center gap-1 px-3">
                                        <i data-feather="arrow-left"></i>
                                        Kembali
                                    </a>

                                    <button type="submit"
                                            class="btn rounded-pill
                                                   d-flex align-items-center gap-1 px-4"
                                            style="background:#388e3c;color:white;">
                                        <i data-feather="save"></i>
                                        Simpan Peta
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
