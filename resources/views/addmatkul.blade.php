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

        <form action="{{ route('mhs.update', $mahasiswa->id) }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="matakuliah" class="col-sm-2 col-form-label">Pilih Matakuliah</label>
                <div class="col-sm-10">
                    <select id="matakuliah" class="form-select mb-2" name="matakuliah" required>
                        <option selected>Pilih Matakuliah</option>
                        @foreach ($matkuliah as $data)
                            <option value="{{ $data->id }}" data-kelp="{{ $data->kelp }}"
                                data-ruangan="{{ $data->ruangan }}">
                                {{ $data->matakuliah }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="kelp" class="col-sm-2 col-form-label">Kelompok</label>
                <div class="col-sm-4">
                    <input type="text" id="kelp" name="kelp" class="form-control" required readonly>
                </div>

                <label for="ruangan" class="col-sm-2 col-form-label">Ruangan</label>
                <div class="col-sm-4">
                    <input type="text" id="ruangan" name="ruangan" class="form-control" required readonly>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-4">Simpan</button>
        </form>

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Kelompok</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwalmhs as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->matakuliah->matakuliah ?? '-' }}</td> <!-- Menampilkan matakuliah -->
                        <td>{{ $data->matakuliah->sks ?? '-' }}</td> <!-- Menampilkan SKS -->
                        <td>{{ $data->kelp ?? '-' }}</td> <!-- Menampilkan Kelompok -->
                        <td>{{ $data->ruangan ?? '-' }}</td> <!-- Menampilkan Ruangan -->
                        <td>
                            <form action="{{ route('jadwal.destroy', $data->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

    <script>
        @if (session('status') == 'success')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('message') }}',
                confirmButtonText: 'Tutup'
            });
        @elseif (session('status') == 'error')
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('message') }}',
                confirmButtonText: 'Tutup'
            });
        @endif
        document.addEventListener("DOMContentLoaded", function() {
            // Ketika ada perubahan pada elemen select dengan id "matakuliah"
            document.getElementById('matakuliah').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex]; // Mendapatkan elemen yang dipilih
                var kelp = selectedOption.getAttribute('data-kelp'); // Mendapatkan nilai kelompok
                var ruangan = selectedOption.getAttribute('data-ruangan'); // Mendapatkan nilai ruangan

                // Mengupdate kolom Kelompok dan Ruangan dengan data dari pilihan
                document.getElementById('kelp').value = kelp;
                document.getElementById('ruangan').value = ruangan;
            });
        });
    </script>

</body>

</html>
