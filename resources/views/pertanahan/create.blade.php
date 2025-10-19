@extends('layouts.app')

@section('title', 'Input Data Pertanahan')

@section('content')
<div class="container mt-4">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show w-75" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <h2 class="mb-4 fw-bold">Form Input Data Pertanahan</h2>

    <form action="{{ route('jenis.store') }}" method="POST" class="mb-5">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Penggunaan</label>
            <input type="text" name="nama_penggunaan" class="form-control w-75" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" rows="3" class="form-control w-75"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data Pertanahan</button>
    </form>

    {{-- TABEL DATA JENIS PENGGUNAAN --}}
    <h3 class="fw-bold mb-3">Data Jenis Penggunaan</h3>
    <table class="table table-bordered table-striped w-75">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Penggunaan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenis_penggunaan as $jenis)
                <tr>
                    <td>{{ $jenis->jenis_id }}</td>
                    <td>{{ $jenis->nama_penggunaan }}</td>
                    <td>{{ $jenis->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
