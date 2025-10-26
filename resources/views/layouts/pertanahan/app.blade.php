<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  @include('layouts.pertanahan.css')
</head>

<body>
    <div class="wrapper">

  <div class="main-panel">
    @include('layouts.pertanahan.header')
    <div class="page-inner">
      @yield('content')
    </div>
  </div>
</div>
  @include('layouts.pertanahan.js')
</body>
</html>
