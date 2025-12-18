@extends('layouts.guest.app')

@section('content')
<div class="container">
    <h1>Tambah Sengketa Persil</h1>

    <form action="{{ route('sengketa_persil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
    <label>Persil</label>
    <select name="persil_id" class="form-control" required>
        <option value="">-- Pilih Persil --</option>
        @foreach($persils as $persil)
            <option value="{{ $persil->persil_id }}">{{ $persil->nama_persil }}</option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label>Pihak 1</label>
            <input type="text" name="pihak_1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pihak 2</label>
            <input type="text" name="pihak_2" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kronologi</label>
            <textarea name="kronologi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="">-- Pilih Status --</option>
        <option value="proses">Proses</option>
        <option value="selesai">Selesai</option>
    </select>
</div>


        <div class="mb-3">
            <label>Penyelesaian</label>
            <input type="text" name="penyelesaian" class="form-control">
        </div>

        <div class="mb-3">
            <label>Upload Bukti</label>
            <input type="file" name="bukti_file[]" multiple class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
