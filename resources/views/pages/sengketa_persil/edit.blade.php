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
                <h2 class="fw-bold text-success">✍️ Edit Sengketa Persil</h2>
                <p class="text-muted">
                    Perbarui informasi sengketa untuk persil terkait.
                </p>
            </div>

            <div class="card border-0 shadow-sm rounded-3 mb-5"
                 style="background:#f8f9f8;">

                {{-- HEADER --}}
                <div class="card-header d-flex align-items-center gap-2 text-white"
                     style="background:#2e7d32;">
                    <i data-feather="alert-triangle"></i>
                    <h6 class="mb-0 fw-semibold">Form Edit Sengketa Persil</h6>
                </div>

                {{-- BODY --}}
                <div class="card-body">
                    <form action="{{ route('sengketa_persil.update', $s->sengketa_id) }}"
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
                                        {{ $s->persil_id == $p->persil_id ? 'selected' : '' }}>
                                        #{{ $p->kode_persil }} - {{ $p->alamat_lahan }}
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
                                       value="{{ old('pihak_1', $s->pihak_1) }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary fw-semibold">
                                    Pihak 2 <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="pihak_2"
                                       class="form-control border-success-subtle shadow-sm"
                                       value="{{ old('pihak_2', $s->pihak_2) }}"
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
                                      class="form-control border-success-subtle shadow-sm">{{ old('kronologi', $s->kronologi) }}</textarea>
                        </div>

                        {{-- STATUS --}}
                        <div class="mb-3">
                            <label class="form-label text-secondary fw-semibold">
                                Status Sengketa
                            </label>
                            <select name="status"
                                    class="form-control border-success-subtle shadow-sm">
                                <option value="proses" {{ $s->status === 'proses' ? 'selected' : '' }}>
                                    Proses
                                </option>
                                <option value="selesai" {{ $s->status === 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </div>

                        {{-- PENYELESAIAN --}}
                        <div class="mb-3">
                            <label class="form-label text-secondary fw-semibold">
                                Penyelesaian
                            </label>
                            <input type="text"
                                   name="penyelesaian"
                                   class="form-control border-success-subtle shadow-sm"
                                   value="{{ old('penyelesaian', $s->penyelesaian) }}"
                                   placeholder="Hasil penyelesaian sengketa">
                        </div>

                        {{-- FILE LAMA --}}
                        @if($s->media->count())
                            <div class="mb-4">
                                <label class="form-label text-secondary fw-semibold">
                                    Bukti Saat Ini
                                </label>

                                <ul class="list-group">
                                    @foreach($s->media as $m)
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/'.$m->file_url) }}"
                                               target="_blank"
                                               class="fw-semibold text-decoration-none">
                                                {{ basename($m->file_url) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- UPLOAD BARU --}}
                        <div class="mb-4">
                            <label class="form-label text-secondary fw-semibold">
                                Upload Bukti Baru
                            </label>
                            <input type="file"
                                   name="files[]"
                                   multiple
                                   class="form-control shadow-sm"
                                   accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx">
                            <small class="text-muted">
                                Bisa upload lebih dari satu file
                            </small>
                        </div>

                        {{-- BUTTON --}}
                        <div class="text-end pt-3 border-top d-flex justify-content-end gap-2">
                            <a href="{{ route('sengketa_persil.index') }}"
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
