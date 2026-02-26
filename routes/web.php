<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| 1. Rute Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [MotorController::class, 'home'])->name('home');


/*
|--------------------------------------------------------------------------
| 2. Rute Guest (Hanya jika belum login)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});


/*
|--------------------------------------------------------------------------
| 3. Rute Terautentikasi (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Proses Keluar
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /**
     * AREA USER BIASA
     */
    
    // PERBAIKAN: Route ini digunakan oleh tombol di Home dan Katalog
    Route::get('/dashboard', [MotorController::class, 'index'])->name('dashboard');
    
    Route::get('/dashboard', [MotorController::class, 'index'])->name('dashboard');
    
    // --- FITUR SEWA & CHECKOUT ---
    
    // Route ini digunakan oleh form "Konfirmasi Sewa" di katalog.blade.php
    Route::post('/sewa/{id}', [SewaController::class, 'store'])->name('sewa.store');
    
    // Rute lama untuk proses penyewaan
    Route::post('/sewa/{id}', [SewaController::class, 'store'])->name('sewa.store');
    
    // Rute Riwayat untuk User
    Route::get('/riwayat-sewa', [SewaController::class, 'index'])->name('rentals.index');
    
    // Route Upload Bukti Bayar
    Route::post('/payment/upload/{id}', [SewaController::class, 'uploadPayment'])->name('payment.upload');
    
    // Route Beri Review
    Route::post('/riwayat-sewa/{id}/review', [SewaController::class, 'storeReview'])->name('rentals.review');


    /**
     * AREA KHUSUS ADMIN
     */
    Route::middleware(['admin'])->group(function () {
        
        // Kelola Data Motor (CRUD)
        Route::resource('motors', MotorController::class)->except(['index', 'show']);

        // Manajemen Transaksi Admin
        Route::get('/admin/rentals', [SewaController::class, 'adminIndex'])->name('admin.rentals.index');
        
        // Update Status (Konfirmasi/Tolak)
        Route::patch('/admin/rentals/{id}', [SewaController::class, 'updateStatus'])->name('admin.rentals.update');
        
        // Balasan Review
        Route::post('/admin/reviews/{id}/reply', [SewaController::class, 'replyReview'])->name('admin.reviews.reply');
    });

});