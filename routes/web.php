<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotorController;

/**
 * Rute awal aplikasi, diarahkan langsung ke halaman login.
 */
Route::get('/', function () {
    return redirect('/login');
});

// --- Rute Autentikasi ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Dashboard & Manajemen Motor (Hanya untuk User yang sudah Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Halaman utama Admin menggunakan method index di MotorController
    Route::get('/dashboard', [MotorController::class, 'index'])->name('dashboard');
    
    /**
     * Route Resource untuk Motor.
     * Baris ini secara otomatis mendaftarkan rute-rute berikut:
     * 1. motors.create  (GET)    -> Form tambah motor
     * 2. motors.store   (POST)   -> Simpan data motor baru
     * 3. motors.edit    (GET)    -> Form edit data motor
     * 4. motors.update  (PUT)    -> Simpan perubahan data motor
     * 5. motors.destroy (DELETE) -> Hapus data motor dari katalog
     * * Catatan: Kita mengecualikan 'index' karena fungsinya sudah diambil alih oleh route '/dashboard'.
     */
    Route::resource('motors', MotorController::class)->except(['index', 'show']);
});