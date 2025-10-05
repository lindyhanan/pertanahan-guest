<!DOCTYPE html>
<html>
<head>
    <title>Data Pertanahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-3">Daftar Persil</h2>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Kode Persil</th>
                <th>Alamat</th>
                <th>Luas (m2)</th>
                <th>Penggunaan</th>
                <th>RT/RW</th>
            </tr>
        </thead>
        <tbody>
            @foreach($persil as $p)
            <tr>
                <td>{{ $p['persil_id'] }}</td>
                <td>{{ $p['kode_persil'] }}</td>
                <td>{{ $p['alamat_lahan'] }}</td>
                <td>{{ $p['luas_m2'] }}</td>
                <td>{{ $p['penggunaan'] }}</td>
                <td>{{ $p['rt'] }}/{{ $p['rw'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="mb-3 mt-5">Daftar Sengketa</h2>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Kode Persil</th>
                <th>Pihak 1</th>
                <th>Pihak 2</th>
                <th>Status</th>
                <th>Kronologi</th>
                <th>Penyelesaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sengketa as $s)
            <tr>
                <td>{{ $s['sengketa_id'] }}</td>
                <td>
                    {{ collect($persil)->firstWhere('persil_id', $s['persil_id'])['kode_persil'] }}
                </td>
                <td>{{ $s['pihak_1'] }}</td>
                <td>{{ $s['pihak_2'] }}</td>
                <td>
                    @if($s['status'] == 'Selesai')
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-warning text-dark">{{ $s['status'] }}</span>
                    @endif
                </td>
                <td>{{ $s['kronologi'] }}</td>
                <td>{{ $s['penyelesaian'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
