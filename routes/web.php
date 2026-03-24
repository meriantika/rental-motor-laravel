<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // ✅ TAMBAHAN
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BrandController;

/*
|--------------------------------------------------------------------------
| TEST DATABASE CONNECTION
|--------------------------------------------------------------------------
*/

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Database CONNECTED";
    } catch (\Exception $e) {
        return "❌ Database NOT CONNECTED: " . $e->getMessage();
    }
});


/*
|--------------------------------------------------------------------------
| 1. PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [MotorController::class, 'home'])->name('home');

Route::get('/motor/{id}', [MotorController::class, 'show'])
    ->name('motor.detail');


/*
|--------------------------------------------------------------------------
| 2. GUEST (BELUM LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');

});


/*
|--------------------------------------------------------------------------
| 3. AUTH (SUDAH LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [MotorController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | PROFILE USER (DATA PENYEWA)
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/profile/edit', function () {
        return view('profile');
    })->name('profile.edit');

    Route::post('/profile/save', [AuthController::class, 'saveProfile'])
        ->name('profile.save');


    Route::post('/profile', function (\Illuminate\Http\Request $request) {

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'address' => $request->address,
        ]);

        $motorId = session('sewa_motor_id');
        $startDate = session('start_date');
        $endDate = session('end_date');

        if ($motorId) {

            $days = \Carbon\Carbon::parse($startDate)
                ->diffInDays(\Carbon\Carbon::parse($endDate));

            $motor = \App\Models\Motor::find($motorId);

            $totalPrice = $motor->price_per_day * $days;

            \App\Models\Rental::create([
                'user_id' => $user->id,
                'motor_id' => $motorId,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_days' => $days,
                'total_price' => $totalPrice,
                'status' => 'pending'
            ]);

            session()->forget(['sewa_motor_id','start_date','end_date']);

            return redirect()->route('rentals.index');
        }

        return redirect()->route('dashboard');

    })->name('profile.store');


    /*
    |--------------------------------------------------------------------------
    | SEWA MOTOR
    |--------------------------------------------------------------------------
    */

    Route::post('/sewa/{id}', [SewaController::class, 'store'])
        ->middleware(\App\Http\Middleware\CheckUserProfile::class)
        ->name('sewa.store');

    Route::post('/sewa/{id}/confirm', [SewaController::class, 'confirm'])
        ->name('sewa.confirm');

    Route::post('/sewa/{id}/cancel', [SewaController::class, 'cancel'])
        ->name('sewa.cancel');


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT SEWA
    |--------------------------------------------------------------------------
    */

    Route::get('/riwayat-sewa', [SewaController::class, 'riwayat'])
        ->name('rentals.index');


    /*
    |--------------------------------------------------------------------------
    | PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    Route::post('/payment/upload/{id}', [SewaController::class, 'uploadPayment'])
        ->name('payment.upload');


    /*
    |--------------------------------------------------------------------------
    | REVIEW MOTOR
    |--------------------------------------------------------------------------
    */

    Route::post('/review/{rental}', [ReviewController::class, 'store'])
        ->name('review.store');


    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    */

    Route::middleware(['admin'])->group(function () {

        Route::resource('motors', MotorController::class)
            ->except(['index', 'show']);

        Route::get('/admin/rentals', [SewaController::class, 'adminIndex'])
            ->name('admin.rentals.index');

        Route::patch('/admin/rentals/{id}', [SewaController::class, 'updateStatus'])
            ->name('admin.rentals.update');

        Route::patch('/admin/rentals/{id}/reset', [SewaController::class, 'resetStatus'])
            ->name('admin.rentals.reset');

        Route::get('/admin/users', function () {
            $users = \App\Models\User::latest()->paginate(10);
            return view('admin.users.index', compact('users'));
        })->name('admin.users.index');

        Route::get('/admin/brands', [BrandController::class,'index'])
            ->name('brands.index');

        Route::post('/admin/brands', [BrandController::class,'store'])
            ->name('brands.store');

        Route::delete('/admin/brands/{id}', [BrandController::class,'destroy'])
            ->name('brands.destroy');

    });

});