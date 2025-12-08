<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Pertanahan</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body style="margin:0; padding:0; height:100vh; width:100vw; overflow:hidden;">

    {{-- INI FULLSCREEN WRAPPER TANPA CONTAINER --}}
    <div style="
        height:100vh;
        width:100vw;
        display:flex;
        justify-content:center;
        align-items:center;
        position:relative;
    ">
        @yield('content')
    </div>

</body>
</html>
