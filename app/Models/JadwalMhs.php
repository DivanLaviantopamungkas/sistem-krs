<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMhs extends Model
{

    use HasFactory;

    protected $table = 'jwl_mhs'; // Tabel jwl_mhs
    protected $fillable = ['mhs_id', 'matkul_id', 'sks', 'kelp', 'ruangan'];


    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_id');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matkul::class, 'matkul_id');
    }
}
