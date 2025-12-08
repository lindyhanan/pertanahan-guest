<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @include('layouts.guest.css')
</head>

<body>
    <div class="wrapper">

        <div class="main-panel">
            @include('layouts.guest.header')
            <div class="page-inner">
                @yield('content')
                    {{-- @include('layouts.guest.footer') --}}
            </div>
        </div>
    </div>
    @include('layouts.guest.js')

</body>

</html>
