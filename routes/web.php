<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\SewaController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', [MotorController::class, 'home'])->name('home');


/*
|--------------------------------------------------------------------------
| 2. GUEST (BELUM LOGIN)
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
| 3. AUTH (SUDAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard motor
    Route::get('/dashboard', [MotorController::class, 'index'])->name('dashboard');

    // Simpan booking
    Route::post('/sewa/{id}', [SewaController::class, 'store'])->name('sewa.store');

    // ✅ KONFIRMASI SEWA
    Route::post('/sewa/{id}/confirm', [SewaController::class, 'confirm'])
        ->name('sewa.confirm');

    // ✅ BATALKAN SEWA
    Route::post('/sewa/{id}/cancel', [SewaController::class, 'cancel'])
        ->name('sewa.cancel');

    // Riwayat sewa user
    Route::get('/riwayat-sewa', [SewaController::class, 'riwayat'])->name('rentals.index');

    // Upload pembayaran
    Route::post('/payment/upload/{id}', [SewaController::class, 'uploadPayment'])->name('payment.upload');

    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->group(function () {

        Route::resource('motors', MotorController::class)->except(['index', 'show']);

        Route::get('/admin/rentals', [SewaController::class, 'adminIndex'])
            ->name('admin.rentals.index');

        Route::patch('/admin/rentals/{id}', [SewaController::class, 'updateStatus'])
            ->name('admin.rentals.update');
    });
});