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

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Input -->
        <form action="{{ route('mhs.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                        name="nim" placeholder="Masukkan NIM" value="{{ old('nim') }}" required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="namaMhs" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control @error('namaMhs') is-invalid @enderror" id="namaMhs"
                        name="namaMhs" placeholder="Masukkan Nama Mahasiswa" value="{{ old('namaMhs') }}" required>
                    @error('namaMhs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="ipk" class="form-label">IPK</label>
                    <input type="number" step="0.01" class="form-control @error('ipk') is-invalid @enderror"
                        id="ipk" name="ipk" placeholder="Masukkan IPK" value="{{ old('ipk') }}" required>
                    @error('ipk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
        </form>

        <!-- Tabel Data KRS -->
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>IPK</th>
                        <th>SKS Maksimal</th>
                        <th>Makul yang diambil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->namaMhs }}</td>
                            <td>{{ $data->nim }}</td>
                            <td>{{ $data->ipk }}</td>
                            <td>{{ $data->sks }}</td>
                            <td>
                                @foreach ($data->jwlMhs as $index => $jadwal)
                                    @if ($jadwal->matakuliah)
                                        {{ $jadwal->matakuliah->matakuliah }} <!-- Menampilkan nama matakuliah -->
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @else
                                        Tidak ada matakuliah
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('mhs.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('mhs.show', $data->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <form action="{{ route('mhs.destroy', $data->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data KRS</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- <script>
        let nomor = 1;

        // Form Submission
        document.getElementById('krsForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const nim = document.getElementById('nim').value;
            const nama = document.getElementById('nama').value;
            const matakuliah = document.getElementById('matakuliah').value;

            // Validasi input kosong
            if (!nim || !nama || !matakuliah) {
                alert('Semua kolom harus diisi!');
                return;
            }

            // Tambahkan data ke tabel
            const tableBody = document.getElementById('krsTableBody');
            const row = document.createElement('tr');
            row.innerHTML = `
        <td>${nomor++}</td>
        <td>${nim}</td>
        <td>${nama}</td>
        <td>${matakuliah}</td>
        <td>
          <button class="btn btn-danger btn-sm" onclick="hapusBaris(this)">Hapus</button>
        </td>
      `;
            tableBody.appendChild(row);

            // Reset form
            document.getElementById('krsForm').reset();
        });

        // Hapus Baris
        function hapusBaris(button) {
            const row = button.parentElement.parentElement;
            row.remove();

            // Reset nomor urut
            nomor = 1;
            const rows = document.querySelectorAll('#krsTableBody tr');
            rows.forEach((row, index) => {
                row.children[0].textContent = index + 1;
            });
        }
    </script> --}}
</body>

</html>
