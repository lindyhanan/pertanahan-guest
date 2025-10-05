<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: #fff;
            padding: 40px 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }

        .login-box h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #7b42f6;
            box-shadow: 0 0 5px rgba(123, 66, 246, 0.3);
        }

        button {
            width: 100%;
            background-color: #7b42f6;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #6a30e8;
        }

        /* Pesan error */
        .alert {
            background-color: #f8d7da;
            color: #842029;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: left;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login Akun</h2>

    {{-- Tampilkan pesan error validasi --}}
    @if ($errors->any())
        <div class="alert">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert">{{ session('error') }}</div>
    @endif

    <form action="{{ url('/auth/login') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
        <input type="password" name="password" placeholder="Masukkan Password">
        <button type="submit">Masuk</button>
    </form>

    <div class="footer">
        <p>© {{ date('Y') }} Sistem Login Sederhana</p>
    </div>
</div>
</body>
</html>