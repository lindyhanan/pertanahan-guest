@extends('layouts.guest.app')

@section('content')
    <div class="content-wrapper py-4">
        <section class="content">
            <div class="container-fluid">
                <form method="GET" action="{{ route('penggunaan.index') }}" class="mb-4 row g-2 align-items-center">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau keterangan..."
                            value="{{ $search ?? '' }}">
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success">Cari</button>
                        <a href="{{ route('penggunaan.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>

                {{-- LIST DATA PENGGUNAAN --}}
                <div class="row">
                    @forelse($data_penggunaan as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 hover-card"
                                style="background-color:#f5f5f5;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3 gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                            style="width:55px; height:55px; background-color:#388e3c; color:white;">
                                            <i data-feather="leaf" class="fs-5"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-semibold text-success mb-0">{{ $item->nama_penggunaan }}</h5>
                                            <small class="text-muted">ID: {{ $item->jenis_id }}</small>
                                        </div>
                                    </div>

                                    <p class="text-muted small">{{ $item->keterangan }}</p>
                                    <hr class="my-3">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('penggunaan.edit', ['penggunaan' => $item->jenis_id]) }}"
                                            class="btn btn-sm btn-outline-success rounded-pill d-flex align-items-center gap-1 px-3">
                                            <i data-feather="edit-3"></i> <span>Edit</span>
                                        </a>
                                        <form action="{{ route('penggunaan.destroy', $item->jenis_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="btn btn-sm btn-outline-danger rounded-pill d-flex align-items-center gap-1 px-3">
                                                <i data-feather="trash-2"></i> <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5 d-flex flex-column align-items-center gap-3">
                            <i data-feather="inbox" class="fs-1"></i>
                            <p class="fs-5">Belum ada data penggunaan lahan.</p>
                        </div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $data_penggunaan->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    </div>

    {{-- Efek hover lembut --}}
    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>

    {{-- Feather Icons --}}
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
@endsection
