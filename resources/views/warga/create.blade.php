@extends('layouts.app')

@section('title', 'Input Data Warga')

@section('content')
<div class="container mt-4">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show w-75" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2 class="mb-4 fw-bold">Form Tambah Data Warga</h2>

    <form action="{{ route('warga.store') }}" method="POST" class="mb-5">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Warga</label>
            <input type="text" name="nama" class="form-control w-75" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No. KTP</label>
            <input type="text" name="no_ktp" class="form-control w-50" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <input type="text" name="jenis_kelamin" class="form-control w-75" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Agama</label>
            <input type="text" name="agama" class="form-control w-50">
        </div>

        <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control w-50">
        </div>

        <div class="mb-3">
            <label class="form-label">Telp</label>
            <input type="text" name="telp" class="form-control w-50">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control w-50">
        </div>

        <button type="submit" class="btn btn-success">Simpan Data Warga</button>
    </form>
</div>
@endsection
