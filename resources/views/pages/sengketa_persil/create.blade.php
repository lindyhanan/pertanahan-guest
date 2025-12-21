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
                        <h2 class="fw-bold text-success">⚠️ Tambah Sengketa Persil</h2>
                        <p class="text-muted">
                            Catat data sengketa yang terjadi pada persil tanah secara lengkap dan terstruktur.
                        </p>
                    </div>

                    <div class="card border-0 shadow-sm mb-5 rounded-3"
                         style="background:#f8f9f8;">

                        {{-- HEADER --}}
                        <div class="card-header d-flex align-items-center gap-2"
                             style="background:#2e7d32;color:white;">
                            <i data-feather="alert-triangle"></i>
                            <h6 class="mb-0 fw-semibold">Form Sengketa Persil</h6>
                        </div>

                        {{-- BODY --}}
                        <div class="card-body">
                            <form action="{{ route('sengketa_persil.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                {{-- PERSIL --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Pilih Persil <span class="text-danger">*</span>
                                    </label>
                                    <select name="persil_id"
                                            class="form-control border-success-subtle shadow-sm"
                                            required>
                                        <option value="">-- Pilih Kode Persil --</option>
                                        @foreach($persils as $p)
                                            <option value="{{ $p->persil_id }}">
                                                {{ $p->kode_persil }} — {{ $p->alamat_lahan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- PIHAK --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-semibold">
                                            Pihak 1 <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="pihak_1"
                                               class="form-control border-success-subtle shadow-sm"
                                               placeholder="Nama pihak pertama"
                                               required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-secondary fw-semibold">
                                            Pihak 2 <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="pihak_2"
                                               class="form-control border-success-subtle shadow-sm"
                                               placeholder="Nama pihak kedua"
                                               required>
                                    </div>
                                </div>

                                {{-- KRONOLOGI --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Kronologi Sengketa
                                    </label>
                                    <textarea name="kronologi"
                                              rows="4"
                                              class="form-control border-success-subtle shadow-sm"
                                              placeholder="Jelaskan kronologi sengketa secara singkat"></textarea>
                                </div>

                                {{-- STATUS --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Status Sengketa <span class="text-danger">*</span>
                                    </label>
                                    <select name="status"
                                            class="form-control border-success-subtle shadow-sm"
                                            required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>

                                {{-- PENYELESAIAN --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Penyelesaian (Opsional)
                                    </label>
                                    <input type="text"
                                           name="penyelesaian"
                                           class="form-control border-success-subtle shadow-sm"
                                           placeholder="Hasil penyelesaian sengketa">
                                </div>

                                {{-- UPLOAD FILE --}}
                                <div class="mb-4">
                                    <label class="form-label text-secondary fw-semibold">
                                        Upload Bukti Sengketa
                                    </label>
                                    <input type="file"
                                           name="bukti_file[]"
                                           multiple
                                           class="form-control shadow-sm"
                                           accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx">
                                    <small class="text-muted">
                                        Bisa upload lebih dari satu file (gambar / dokumen).
                                    </small>
                                </div>

                                {{-- BUTTON --}}
                                <div class="text-end mt-4 pt-3 border-top
                                            d-flex justify-content-end gap-2">
                                    <a href="{{ route('sengketa_persil.index') }}"
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
                                        Simpan Sengketa
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
