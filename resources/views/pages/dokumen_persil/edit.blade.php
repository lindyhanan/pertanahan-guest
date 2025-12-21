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
                        <h2 class="fw-bold text-success">✍️ Edit Dokumen Persil</h2>
                        <p class="text-muted">
                            Perbarui data dokumen untuk persil terkait.
                        </p>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3 mb-5"
                         style="background:#f8f9f8;">

                        {{-- HEADER --}}
                        <div class="card-header d-flex align-items-center gap-2 text-white"
                             style="background:#2e7d32;">
                            <i data-feather="file-text"></i>
                            <h6 class="mb-0 fw-semibold">Form Edit Dokumen Persil</h6>
                        </div>

                        {{-- BODY --}}
                        <div class="card-body">
                            <form action="{{ route('dokumen_persil.update', $dokumen->dokumen_id) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- PILIH PERSIL --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Pilih Persil <span class="text-danger">*</span>
                                    </label>
                                    <select name="persil_id"
                                            class="form-control border-success-subtle shadow-sm"
                                            required>
                                        <option value="">-- Pilih Persil --</option>
                                        @foreach($persils as $p)
                                            <option value="{{ $p->persil_id }}"
                                                {{ $dokumen->persil_id == $p->persil_id ? 'selected' : '' }}>
                                                #{{ $p->kode_persil }} - {{ $p->alamat_lahan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- JENIS --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Jenis Dokumen <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="jenis_dokumen"
                                           class="form-control border-success-subtle shadow-sm"
                                           value="{{ old('jenis_dokumen', $dokumen->jenis_dokumen) }}"
                                           required>
                                </div>

                                {{-- NOMOR --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Nomor Dokumen <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="nomor"
                                           class="form-control border-success-subtle shadow-sm"
                                           value="{{ old('nomor', $dokumen->nomor) }}"
                                           required>
                                </div>

                                {{-- KETERANGAN --}}
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-semibold">
                                        Keterangan
                                    </label>
                                    <textarea name="keterangan"
                                              rows="3"
                                              class="form-control border-success-subtle shadow-sm">{{ old('keterangan', $dokumen->keterangan) }}</textarea>
                                </div>

                                {{-- FILE LAMA --}}
                                @if($dokumen->media->count())
                                    <div class="mb-4">
                                        <label class="form-label text-secondary fw-semibold">
                                            File Terlampir
                                        </label>

                                        <ul class="list-group">
                                            @foreach($dokumen->media as $file)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <a href="{{ asset('storage/'.$file->file_url) }}"
                                                       target="_blank"
                                                       class="fw-semibold text-decoration-none">
                                                        {{ basename($file->file_url) }}
                                                    </a>

                                                    <form action="{{ route('dokumen_persil.media.destroy', [
                                                            'dokumen' => $dokumen->dokumen_id,
                                                            'media'   => $file->media_id
                                                        ]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Hapus file ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger rounded-pill">
                                                            <i data-feather="trash-2" width="14"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- UPLOAD BARU --}}
                                <div class="mb-4">
                                    <label class="form-label text-secondary fw-semibold">
                                        Upload File Baru
                                    </label>
                                    <input type="file"
                                           name="files[]"
                                           multiple
                                           class="form-control shadow-sm"
                                           accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    <small class="text-muted">
                                        Bisa upload lebih dari satu file
                                    </small>
                                </div>

                                {{-- BUTTON --}}
                                <div class="text-end pt-3 border-top d-flex justify-content-end gap-2">
                                    <a href="{{ route('dokumen_persil.index') }}"
                                       class="btn btn-outline-secondary rounded-pill px-4 d-flex align-items-center gap-1">
                                        <i data-feather="x"></i>
                                        Batal
                                    </a>

                                    <button type="submit"
                                            class="btn rounded-pill px-4 d-flex align-items-center gap-1"
                                            style="background:#388e3c;color:white;">
                                        <i data-feather="save"></i>
                                        Update
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

<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace()</script>
@endsection
