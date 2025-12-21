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
                        <h2 class="fw-bold text-success">📄 Tambah Dokumen Persil</h2>
                        <p class="text-muted">
                            Masukkan informasi dokumen resmi yang terkait dengan persil tanah.
                        </p>
                    </div>

                    <div class="card border-0 shadow-sm mb-5 rounded-3"
                         style="background:#f8f9f8;">

                        {{-- HEADER --}}
                        <div class="card-header d-flex align-items-center gap-2"
                             style="background:#2e7d32;color:white;">
                            <i data-feather="file-text"></i>
                            <h6 class="mb-0 fw-semibold">Form Dokumen Persil</h6>
                        </div>

                        {{-- BODY --}}
                        <div class="card-body">
                            <form action="{{ route('dokumen_persil.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                {{-- PERSIL --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Pilih Persil <span class="text-danger">*</span>
                                    </label>
                                    <select name="persil_id"
                                            class="form-control border-success-subtle
                                                   @error('persil_id') is-invalid @enderror"
                                            required>
                                        <option value="">-- Pilih Kode Persil --</option>
                                        @foreach ($persils as $p)
                                            <option value="{{ $p->persil_id }}"
                                                {{ old('persil_id') == $p->persil_id ? 'selected' : '' }}>
                                                {{ $p->kode_persil }} — {{ $p->alamat_lahan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('persil_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- GRID --}}
                                <div class="row">
                                    {{-- JENIS DOKUMEN --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-semibold">
                                            Jenis Dokumen <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="jenis_dokumen"
                                               class="form-control border-success-subtle
                                                      @error('jenis_dokumen') is-invalid @enderror"
                                               value="{{ old('jenis_dokumen') }}"
                                               placeholder="Contoh: Sertifikat, AJB, SHM"
                                               required>
                                        @error('jenis_dokumen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- NOMOR --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-semibold">
                                            Nomor Dokumen <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="nomor"
                                               class="form-control border-success-subtle
                                                      @error('nomor') is-invalid @enderror"
                                               value="{{ old('nomor') }}"
                                               placeholder="Nomor dokumen resmi"
                                               required>
                                        @error('nomor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- KETERANGAN --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Keterangan
                                    </label>
                                    <textarea name="keterangan"
                                              rows="3"
                                              class="form-control border-success-subtle"
                                              placeholder="Catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                                </div>

                                {{-- UPLOAD --}}
                                <div class="mb-4">
                                    <label class="form-label text-secondary fw-semibold">
                                        Upload File Dokumen
                                    </label>
                                    <input type="file"
                                           name="files[]"
                                           multiple
                                           class="form-control"
                                           accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    <small class="text-muted">
                                        Bisa upload lebih dari satu file. Maks 5 MB per file.
                                    </small>
                                </div>

                                {{-- ACTION --}}
                                <div class="text-end mt-4 pt-3 border-top
                                            d-flex justify-content-end gap-2">
                                    <a href="{{ route('dokumen_persil.index') }}"
                                       class="btn btn-outline-secondary rounded-pill
                                              d-flex align-items-center gap-1 px-3">
                                        <i data-feather="arrow-left"></i>
                                        Batal / Kembali
                                    </a>

                                    <button type="submit"
                                            class="btn rounded-pill
                                                   d-flex align-items-center gap-1 px-4"
                                            style="background:#388e3c;color:white;">
                                        <i data-feather="save"></i>
                                        Simpan Dokumen
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
