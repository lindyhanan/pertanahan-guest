@extends('layouts.pertanahan.auth')

@section('content')
<div class="card shadow-lg p-4" style="width: 400px; border-radius: 15px;">
    <h3 class="text-center mb-4">Login</h3>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
        </div>
        <div class="form-group mb-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <a href="{{route('user.create')}}"><center>Buat Akun</center></a>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection
