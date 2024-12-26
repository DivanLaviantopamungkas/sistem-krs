<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input KRS Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center">Sistem Input Kartu Rencana Studi (KRS)</h2>
        <p class="text-center text-muted">Input data KRS mahasiswa dengan mudah dan cepat!</p>

        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <div>
                <strong>Mahasiswa:</strong> {{ $mahasiswa->namaMhs }} | <strong>NIM:</strong> {{ $mahasiswa->nim }}
                | <strong>IPK:</strong> {{ $mahasiswa->ipk }}
            </div>
            <a href="{{ route('mhs.index') }}" class="btn btn-warning btn-sm">Kembali ke data mahasiswa</a>
        </div>

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Kelompok</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwalmhs as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->matakuliah->matakuliah ?? '-' }}</td>
                        <td>{{ $data->matakuliah->sks ?? '-' }}</td>
                        <td>{{ $data->kelp ?? '-' }}</td>
                        <td>{{ $data->ruangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('cetak-krs', ['id' => $mahasiswa->id]) }}">
            <button class="btn btn-success">Cetak KRS (PDF)</button>
        </a>
    </div>
    </div>

</body>

</html>
