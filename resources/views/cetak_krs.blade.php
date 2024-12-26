<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Rencana Studi</title>
    <style>
        /* Masukkan CSS Anda di sini */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 900px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 24px;
            color: #333;
        }

        .header p {
            font-size: 16px;
            color: #666;
        }

        .student-info {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .student-info p {
            margin: 5px 0;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .schedule-table th,
        .schedule-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .schedule-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .schedule-table tfoot {
            font-weight: bold;
            background-color: #f4f4f4;
        }

        .schedule-table tfoot td {
            text-align: right;
            padding-right: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Kartu Rencana Studi</h2>
            <p>Detail jadwal kuliah mahasiswa</p>
        </div>

        <!-- Informasi Mahasiswa -->
        <div class="student-info">
            <p><strong>Nama:</strong> {{ $mahasiswa->namaMhs }}</p>
            <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
            <p><strong>IPK:</strong> {{ $mahasiswa->ipk }}</p>
        </div>

        <!-- Tabel Jadwal Kuliah -->
        <table class="schedule-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Kelompok</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSKS = 0; @endphp
                @foreach ($jadwalmhs as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->matakuliah->matakuliah ?? '-' }}</td>
                        <td>{{ $data->matakuliah->sks ?? 0 }}</td>
                        <td>{{ $data->kelp ?? '-' }}</td>
                        <td>{{ $data->ruangan ?? '-' }}</td>
                    </tr>
                    @php
                        $totalSKS += $data->matakuliah->sks ?? 0;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total SKS</td>
                    <td>{{ $totalSKS }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
