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

Route::middleware(['auth'])->group(function () {
    Route::get('/tiket/{id}', [PesertaController::class, 'tiket']);
    Route::post('/tiket/{id}', [PesertaController::class, 'kirim']);
    Route::get('/riwayat', [PesertaController::class, 'riwayat']);
    Route::get('/bayar/{id}', [PesertaController::class, 'bayar']);
});

# ======================
# AUTH
# ======================
Route::get('/login', [AdminController::class, 'signin'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::get('/logout', [AdminController::class, 'logout'])->middleware('auth');

# ======================
# ADMIN (WAJIB LOGIN)
# ======================
Route::middleware(['auth'])->group(function () {

    # Dashboard Admin (menampilkan event)
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    # CRUD Peserta
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