@extends('layouts.guest.app')

@section('content')
<div class="content-wrapper py-4">
<section class="content">
<div class="container-fluid">

    <h4 class="fw-bold text-success mb-4">Edit Dokumen Persil</h4>

    <form action="{{ route('dokumen_persil.update', $dokumen->dokumen_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Pilih Persil --}}
        <div class="mb-3">
            <label for="persil_id" class="form-label">Pilih Persil</label>
            <select name="persil_id" id="persil_id" class="form-control" required>
                <option value="">-- Pilih Persil --</option>
                @foreach($persils as $p)
                    <option value="{{ $p->persil_id }}" {{ $dokumen->persil_id == $p->persil_id ? 'selected' : '' }}>
                        #{{ $p->kode_persil }} - {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jenis Dokumen --}}
        <div class="mb-3">
            <label for="jenis_dokumen" class="form-label">Jenis Dokumen</label>
            <input type="text" name="jenis_dokumen" id="jenis_dokumen" class="form-control" value="{{ $dokumen->jenis_dokumen }}" required>
        </div>

        {{-- Nomor Dokumen --}}
        <div class="mb-3">
            <label for="nomor" class="form-label">Nomor Dokumen</label>
            <input type="text" name="nomor" id="nomor" class="form-control" value="{{ $dokumen->nomor }}" required>
        </div>

        {{-- Keterangan --}}
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $dokumen->keterangan }}</textarea>
        </div>

        {{-- File Lama --}}
        @if($dokumen->media->count())
            <div class="mb-3">
                <label class="form-label">File Terlampir</label>
                <ul>
                    @foreach($dokumen->media as $file)
                        <li>
                            <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">{{ basename($file->file_path) }}</a>
                            <form action="{{ route('dokumen_persil.media.destroy', [$dokumen->dokumen_id, $file->media_id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus file ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger ms-2">Hapus</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Upload File Baru --}}
        <div class="mb-3">
            <label for="files" class="form-label">Upload File Baru (Bisa multiple)</label>
            <input type="file" name="files[]" id="files" class="form-control" multiple>
            <small class="text-muted">Gambar atau dokumen lain (PDF, Word, dll)</small>
        </div>

        <button type="submit" class="btn btn-success rounded-pill px-4">Update</button>
        <a href="{{ route('dokumen_persil.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
    </form>

</div>
</section>
</div>
@endsection
