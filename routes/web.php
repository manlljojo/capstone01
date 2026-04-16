<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

# ======================
# HALAMAN USER
# ======================
Route::get('/', [PesertaController::class, 'index']);

Route::middleware(['auth:pengguna'])->group(function () {
    Route::get('/tiket/{id}', [PesertaController::class, 'tiket']);
    Route::post('/tiket/{id}', [PesertaController::class, 'kirim']);
    Route::get('/riwayat', [PesertaController::class, 'riwayat']);
    Route::get('/bayar/{id}', [PesertaController::class, 'bayar']);
    Route::delete('/peserta/batal/{id}', [PesertaController::class, 'batal'])->name('peserta.batal');
    Route::get('/cetak-tiket/{id}', [PesertaController::class, 'cetak'])->name('cetak_tiket');
});

# ======================
# AUTH
# ======================
Route::get('/login', [AdminController::class, 'signin'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::get('/logout', [AdminController::class, 'logout']); // Remove middleware to allow logout from any guard

Route::middleware(['auth:admin,penyelenggara'])->group(function () {

    # Dashboard Admin (menampilkan event)
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    # Laporan Laporan
    Route::get('/daftar', [AdminController::class, 'daftar']);
    Route::get('/edit/{id}', [AdminController::class, 'ubah']);
    Route::put('/edit/{id}', [AdminController::class, 'ubahput']);
    Route::delete('/delete/{id}', [AdminController::class, 'delete']);

    # Check-in
    Route::post('/checkin', [AdminController::class, 'checkin']);
    Route::post('/admin/checkin/{id}', [AdminController::class, 'toggleCheckin']);
    Route::post('/admin/confirm-payment/{id}', [AdminController::class, 'confirmPayment']);

    # CRUD Event (INI PENTING 🔥)
    Route::resource('events', EventController::class);
});