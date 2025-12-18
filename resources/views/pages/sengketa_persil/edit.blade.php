@extends('layouts.guest.app')

@section('content')
<div class="container">
    <h1>Edit Sengketa Persil</h1>

    <form action="{{ route('sengketa_persil.update', $s->sengketa_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Persil</label>
            <input type="number" name="persil_id" value="{{ $s->persil_id }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pihak 1</label>
            <input type="text" name="pihak_1" value="{{ $s->pihak_1 }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pihak 2</label>
            <input type="text" name="pihak_2" value="{{ $s->pihak_2 }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kronologi</label>
            <textarea name="kronologi" class="form-control">{{ $s->kronologi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" value="{{ $s->status }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Penyelesaian</label>
            <input type="text" name="penyelesaian" value="{{ $s->penyelesaian }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Upload Bukti Baru</label>
            <input type="file" name="bukti_file[]" multiple class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <h5 class="mt-3">Bukti Saat Ini</h5>
    @foreach($s->media as $m)
        <a href="{{ asset('storage/'.$m->file_path) }}" target="_blank">{{ $m->file_path }}</a><br>
    @endforeach
</div>
@endsection
