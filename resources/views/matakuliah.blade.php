<form action="{{ route('matkul.store') }}" method="POST" class="mb-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label for="matakuliah" class="form-label">mata kuliah</label>
            <input type="text" class="form-control " id="matakuliah" name="matakuliah" placeholder="Masukkan NIM"
                required>
        </div>
        <div class="col-md-4">
            <label for="sks" class="form-label">sks</label>
            <input type="text" class="form-control" id="sks" name="sks"
                placeholder="Masukkan Nama Mahasiswa" required>
        </div>
        <div class="col-md-4">
            <label for="kelp" class="form-label">kelp</label>
            <input type="tex" step="0.01" class="form-control" id="kelp" name="kelp"
                placeholder="Masukkan IPK" required>

        </div>
        <div class="col-md-4">
            <label for="ruangan" class="form-label">ruangan</label>
            <input type="number" step="0.01" class="form-control" id="ruangan" name="ruangan"
                placeholder="Masukkan IPK" required>

        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
</form>
