@extends('layouts.guest.auth')

@section('content')

    {{-- FULLSCREEN BACKGROUND --}}
    <div
        style="
            position:fixed;
            top:0; left:0;
            width:100vw;
            height:100vh;
            background:url('{{ asset('assets/img/pertanahan-bg.jpg') }}') center/cover no-repeat;
            z-index:-3;
        ">
    </div>

    {{-- OVERLAY BLUR --}}
    <div
        style="
            position:fixed;
            top:0; left:0;
            width:100vw;
            height:100vh;
            background:rgba(255,255,255,0.35);
            backdrop-filter:blur(7px);
            z-index:-2;
        ">
    </div>

    {{-- WRAPPER TENGAH FULLSCREEN --}}
    <div
        style="
            width:100vw;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            position:relative;
            z-index:10;
        ">

        {{-- GLASS CARD --}}
        <div
            style="
                background:rgba(255,255,255,0.55);
                backdrop-filter:blur(12px);
                border-radius:18px;
                width:420px;
                padding:35px;
                box-shadow:0 8px 28px rgba(0,0,0,0.25);
            ">

            <h3 class="text-center mb-4" style="font-weight:700; color:#2e7d32;">
                Buat Akun
            </h3>

            {{-- Error general --}}
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Ganti action route sesuai route register kamu --}}
            <form action="{{ route('register.post') }}" method="POST" style="text-align:justify;">
                @csrf

                <label>Nama</label>
                <input type="text" name="name" class="form-control mb-3" value="{{ old('name') }}" required>

                <label>Email</label>
                <input type="email" name="email" class="form-control mb-3" value="{{ old('email') }}" required>

                <label>Daftar Sebagai</label>
<select name="role" class="form-control mb-3" required>
    <option value="">Pilih Role</option>
    <option value="klien" {{ old('role') == 'klien' ? 'selected' : '' }}>Klien</option>
    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
</select>

                <label>Password</label>
                <input type="password" name="password" class="form-control mb-3" required>

                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control mb-4" required>

                <button type="submit" class="btn w-100"
                    style="background:#2e7d32; color:white; border-radius:10px; font-weight:600;">
                    Daftar
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-dark">
                        Sudah punya akun? Login
                    </a>
                </div>
            </form>

        </div>
    </div>
@endsection
