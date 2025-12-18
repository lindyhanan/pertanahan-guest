@extends('layouts.guest.app')

@section('content')
<div class="container">
    <h1>Edit Peta Persil</h1>

    <form action="{{ route('peta_persil.update', $p->peta_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Persil</label>
            <input type="number" name="persil_id" value="{{ $p->persil_id }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Panjang (m)</label>
            <input type="number" step="0.01" name="panjang_m" value="{{ $p->panjang_m }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Lebar (m)</label>
            <input type="number" step="0.01" name="lebar_m" value="{{ $p->lebar_m }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>GeoJSON</label>
            <textarea name="geojson" class="form-control">{{ $p->geojson }}</textarea>
        </div>

        <div class="mb-3">
            <label>Upload Peta Baru</label>
            <input type="file" name="peta_file[]" multiple class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <h5 class="mt-3">File Peta Saat Ini</h5>
    @foreach($p->media as $m)
        <a href="{{ asset('storage/'.$m->file_path) }}" target="_blank">{{ $m->file_path }}</a><br>
    @endforeach
</div>
@endsection
