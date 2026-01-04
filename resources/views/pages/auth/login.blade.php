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
    justify-content:center;   /* TENGAH KIRI-KANAN */
    align-items:center;        /* TENGAH ATAS-BAWAH */
    position:relative;
    z-index:10;
">

        {{-- GLASS CARD --}}
        <div
            style="
        background:rgba(255,255,255,0.55);
        backdrop-filter:blur(12px);
        border-radius:18px;
        width:380px;
        padding:35px;
        box-shadow:0 8px 28px rgba(0,0,0,0.25);
    ">

            <h3 class="text-center mb-4" style="font-weight:700; color:#2e7d32;">
                Login
            </h3>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" style="text-align:justify;">
                @csrf

                <label>Email</label>
                <input type="email" name="email" class="form-control mb-3" required>

                <label>Password</label>
                <input type="password" name="password" class="form-control mb-4" required>

                <button type="submit" class="btn w-100"
                    style="background:#2e7d32; color:white; border-radius:10px; font-weight:600;">
                    Login
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('register') }}" class="text-dark">
                        Buat Akun
                    </a>
                </div>
            </form>

        </div>
    </div>
