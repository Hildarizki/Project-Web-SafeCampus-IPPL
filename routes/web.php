<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');

Route::get('/riwayat', function () {
    return view('riwayat');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/mahasiswa', function () {
    return view('mahasiswa');
});

/// FORM BUAT LAPORAN
Route::get('/laporan', [LaporanController::class, 'create'])
    ->name('laporan.create');

/// SIMPAN LAPORAN BARU
Route::post('/laporan', [LaporanController::class, 'store'])
    ->name('laporan.store');

/// HALAMAN RIWAYAT LAPORAN
Route::get('/laporan/riwayat', [LaporanController::class, 'index'])
    ->name('laporan.index');

/// DETAIL SATU LAPORAN
Route::get('/laporan/{id}', [LaporanController::class, 'show'])
    ->name('laporan.show');

/// UPDATE STATUS LAPORAN (opsional untuk admin/konselor)
Route::put('/laporan/{id}', [LaporanController::class, 'update'])
    ->name('laporan.update');

/// HAPUS LAPORAN (opsional)
Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])
    ->name('laporan.destroy');

Route::get('/artikel', function () {
    return view('artikel');
});

Route::get('/chat', function () {
    return view('chat');
})->name('chat');