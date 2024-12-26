<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mhs.index');
Route::post('/mhs/store', [MahasiswaController::class, 'store'])->name('mhs.store');
Route::get('/{id}/edit', [MahasiswaController::class, 'edit'])->name('mhs.edit');
Route::post('mhs/{id}/add-matkul', [MahasiswaController::class, 'update'])->name('mhs.update');
Route::get('/{id}/show', [MahasiswaController::class, 'show'])->name('mhs.show');
Route::delete('/destroy', [MahasiswaController::class, 'destroy'])->name('mhs.destroy');
Route::delete('{id}/destroyjadwal', [MahasiswaController::class, 'jadwaldestroy'])->name('jadwal.destroy');
Route::get('/{id}/cetak-krs', [MahasiswaController::class, 'cetakKRS'])->name('cetak-krs');
