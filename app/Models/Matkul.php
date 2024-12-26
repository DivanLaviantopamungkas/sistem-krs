<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $table = 'jwl_matakuliah';

    protected $fillable = [
        'matakuliah',
        'sks',
        'kelp',
        'ruangan'
    ];
}
