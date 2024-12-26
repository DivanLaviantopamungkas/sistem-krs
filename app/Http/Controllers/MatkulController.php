<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index()
    {
        return view('matakuliah');
    }

    public function store(Request $request)
    {
        Matkul::create([
            'matakuliah' => $request->matakuliah,
            'sks' => $request->sks,
            'kelp' => $request->kelp,
            'ruangan' => $request->ruangan
        ]);

        return redirect()->back()->with('success', 'Berhasil!');
    }
}
