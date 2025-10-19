<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PERTANAHAN')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #2c3e50;
            color: white;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #1a252f;
        }
        .content {
            padding: 30px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        {{-- Sidebar kiri --}}
        <div class="col-md-3 col-lg-2 sidebar d-flex flex-column justify-content-between">
            <div>
                <h3 class="text-center py-3 fw-bold">PERTANAHAN</h3>
                <a href="{{ route('jenis.create') }}">Input Data Pertanahan</a>
                <li class="nav-item">
    <a class="nav-link" href="{{ route('warga.create') }}">
        <i class="bi bi-person-fill"></i> Input Data Warga
    </a>
</li>
            </div>
            <div class="text-center py-3 small">&copy; 2025</div>
        </div>
        

        {{-- Konten utama --}}
        <div class="col-md-9 col-lg-10 content">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
