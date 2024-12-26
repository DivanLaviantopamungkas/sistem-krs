<?php

namespace App\Http\Controllers;

use App\Models\JadwalMhs;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('jwlMhs.matakuliah')->get();
        // dd($mahasiswa);
        return view('dashboard', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'namaMhs' => 'required',
            'ipk' => 'required',
        ]);

        $ipk = $request->ipk;
        $sks_max = $this->claculateSks($ipk);

        Mahasiswa::create([
            'nim' => $request->nim,
            'namaMhs' => $request->namaMhs,
            'ipk' => $ipk,
            'sks' => $sks_max,
        ]);

        return redirect()->back()->with('sucsses', 'Data Mahasiswa Berhasil ditambahakan');
    }

    public function claculateSks($ipk)
    {
        if ($ipk >= 3.0) {
            return 24;
        } elseif ($ipk >= 2.0) {
            return 22;
        } else {
            return 18;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findorFail($id);

        $jadwalmhs = JadwalMhs::with('matakuliah')
            ->where('mhs_id', $mahasiswa->id)
            ->get();

        return view('showmatkul', compact('mahasiswa', 'jadwalmhs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findorFail($id);
        $matkuliah = Matkul::All();
        $jadwalmhs = JadwalMhs::with('matakuliah')
            ->where('mhs_id', $mahasiswa->id)
            ->get();

        return view('addmatkul', compact('mahasiswa', 'matkuliah', 'jadwalmhs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'matakuliah' => 'required|integer',
            'kelp' => 'required|string',
            'ruangan' => 'required|string',
        ]);

        $mahasiswa = Mahasiswa::findorFail($id);

        $matkuliah = Matkul::find($request->input('matakuliah'));

        JadwalMhs::create([
            'mhs_id' => $mahasiswa->id,
            'matkul_id' => $request->input('matakuliah'),
            'kelp' => $request->input('kelp'),
            'ruangan' => $request->input('ruangan'),
            'sks' => $matkuliah->sks
        ]);

        $mahasiswa->update([
            'matakuliah' => $request->input('matakuliah')
        ]);

        return redirect()->back()->with('success', 'Mata Kuliah Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect()->back()->with('succsses', 'Data Berhasil dihapus');
    }

    public function jadwaldestroy(string $id)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = JadwalMhs::find($id);

        if ($jadwal) {
            // Ambil matkul_id untuk penghapusan yang tepat
            $matkul_id = $jadwal->matkul_id;

            // Hapus jadwal mahasiswa
            $jadwal->delete();

            // Hapus matakuliah di Inputmhs berdasarkan matakuliah, hanya matakuliah yang dihapus
            Mahasiswa::where('matakuliah', $matkul_id)->update(['matakuliah' => null]);

            return redirect()->back()->with('success', 'Jadwal dan matakuliah berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Jadwal tidak ditemukan');
    }

    public function cetakKRS(string $id, PDF $pdf)
    {
        $mahasiswa = Mahasiswa::findorFail($id);

        $jadwalmhs = JadwalMhs::with('matakuliah')
            ->where('mhs_id', $id)
            ->get();

        $pdf = $pdf->loadView('cetak_krs', compact('mahasiswa', 'jadwalmhs'));
        return $pdf->download('KRS_' . $mahasiswa->nim . '.pdf');
    }
}
