<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'inputmhs';

    protected $fillable = [
        'id',
        'namaMhs',
        'nim',
        'ipk',
        'sks',
        'matakuliah'
    ];

    public function jwlMhs()
    {
        return $this->hasMany(JadwalMhs::class, 'mhs_id', 'id');  // Relasi dengan JwlMhs
    }
}
