@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
<section class="content">
<div class="container-fluid">

    <h4 class="fw-bold text-success mb-4">Tambah Dokumen Persil</h4>

    <form action="{{ route('dokumen_persil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Pilih Persil --}}
        <div class="mb-3">
            <label for="persil_id" class="form-label">Pilih Persil</label>
            <select name="persil_id" id="persil_id" class="form-control" required>
                <option value="">-- Pilih Persil --</option>
                @foreach($persils as $p)
                    <option value="{{ $p->persil_id }}" {{ old('persil_id') == $p->persil_id ? 'selected' : '' }}>
                        #{{ $p->kode_persil }} - {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jenis Dokumen --}}
        <div class="mb-3">
            <label for="jenis_dokumen" class="form-label">Jenis Dokumen</label>
            <input type="text" name="jenis_dokumen" id="jenis_dokumen" class="form-control" value="{{ old('jenis_dokumen') }}" required>
        </div>

        {{-- Nomor Dokumen --}}
        <div class="mb-3">
            <label for="nomor" class="form-label">Nomor Dokumen</label>
            <input type="text" name="nomor" id="nomor" class="form-control" value="{{ old('nomor') }}" required>
        </div>

        {{-- Keterangan --}}
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
        </div>

        {{-- Upload File --}}
        <div class="mb-3">
            <label for="files" class="form-label">Upload File (Bisa multiple)</label>
            <input type="file" name="files[]" id="files" class="form-control" multiple>
            <small class="text-muted">Gambar atau dokumen lain (PDF, Word, dll)</small>
        </div>

        <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
        <a href="{{ route('dokumen_persil.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
    </form>

</div>
</section>
</div>
@endsection
