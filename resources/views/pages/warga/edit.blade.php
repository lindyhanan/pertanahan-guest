@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
<section class="content">
<div class="container-fluid">

    {{-- ALERT --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-success">✏️ Edit Data Warga</h4>
        <a href="{{ route('warga.index') }}"
           class="btn btn-outline-success rounded-pill px-3">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('warga.update', $warga->warga_id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
{{-- NOMOR WARGA (OTOMATIS) --}}
<div class="col-md-6">
    <label class="form-label fw-semibold">
        ID Warga
    </label>
    <input type="text"
           class="form-control bg-light"
           value="{{ $warga->warga_id }}"
           readonly>

    <small class="text-muted">
        Nomor ini dibuat otomatis oleh sistem
    </small>
</div>

                    {{-- NAMA --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ old('nama', $warga->nama) }}"
                               required>
                    </div>

                    {{-- PEKERJAAN --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pekerjaan</label>
                        <input type="text"
                               name="pekerjaan"
                               class="form-control"
                               value="{{ old('pekerjaan', $warga->pekerjaan) }}">
                    </div>

                    {{-- NO KTP --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">No KTP</label>
                        <input type="text"
                               name="no_ktp"
                               class="form-control"
                               value="{{ old('no_ktp', $warga->no_ktp) }}">
                    </div>

                    {{-- TELP --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">No Telp</label>
                        <input type="text"
                               name="telp"
                               class="form-control"
                               value="{{ old('telp', $warga->telp) }}">
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $warga->email) }}">
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    {{-- FILE / FOTO --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Foto Warga (opsional)
                        </label>
                        <input type="file"
                               name="foto"
                               class="form-control"
                               accept="image/*">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>

                        @if ($warga->foto)
                            <div class="mt-3">
                                <p class="mb-1 text-muted">Foto saat ini:</p>
                                <img src="{{ asset('storage/'.$warga->foto) }}"
                                     class="rounded shadow-sm"
                                     style="max-height:150px;">
                            </div>
                        @endif
                    </div>

                </div>

                <hr class="my-4">

                {{-- ACTION --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('warga.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-4">
                        Batal
                    </a>
                    <button class="btn btn-success rounded-pill px-4">
                        <i data-feather="save"></i> Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
</section>
</div>

<script>
    feather.replace();
</script>
@endsection
