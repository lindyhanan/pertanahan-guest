@extends('layouts.guest.app')

@section('content')
<div class="container">
    <h1>Tambah Peta Persil</h1>

    <form action="{{ route('peta_persil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Persil</label>
            <input type="number" name="persil_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Panjang (m)</label>
            <input type="number" step="0.01" name="panjang_m" class="form-control">
        </div>

        <div class="mb-3">
            <label>Lebar (m)</label>
            <input type="number" step="0.01" name="lebar_m" class="form-control">
        </div>

        <div class="mb-3">
            <label>GeoJSON</label>
            <textarea name="geojson" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Upload Peta</label>
            <input type="file" name="peta_file[]" multiple class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
