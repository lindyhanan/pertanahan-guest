
@extends('layouts.pertanahan.app')

@section('content')
{{-- ======= START LIST DATA WARGA ======= --}}
            <div class="row">
                @foreach($warga as $item)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm mb-4 h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:45px; height:45px;">
                                        <i class="fas fa-user" href="{{asset('assets/img/arashmil.jpg')}}"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0">{{ $item->nama }}</h6>
                                        <small class="text-muted">{{ $item->pekerjaan }}</small>
                                    </div>
                                </div>
                                <p class="mb-1"><i class="fas fa-id-card me-2 text-secondary"></i>{{ $item->no_ktp }}</p>
                                <p class="mb-1"><i class="fas fa-phone me-2 text-secondary"></i>{{ $item->telp }}</p>
                                <p class="mb-1"><i class="fas fa-envelope me-2 text-secondary"></i>{{ $item->email }}</p>
                                <div class="mt-3 d-flex justify-content-between">
                                    <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
<div class="content-wrapper" style="margin-top: 100px;"> 

    <section class="content">
        <div class="container-fluid">
            {{-- Flashdata --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FORM TAMBAH WARGA --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-user-plus me-2"></i> Tambah Data Warga</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('warga.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor KTP</label>
                                <input type="text" name="no_ktp" class="form-control" maxlength="16" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" maxlength="50" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" name="agama" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="telp" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- ======= END FORM TAMBAH WARGA ======= --}}

            
            {{-- ======= END LIST DATA WARGA ======= --}}
        </div>
    </section>
</div>
@endsection