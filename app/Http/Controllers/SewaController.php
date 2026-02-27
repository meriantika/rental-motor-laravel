<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SewaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Motor
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $motors = Motor::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('dashboard', compact('motors'));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Booking
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $motor = Motor::findOrFail($id);

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $durasi = $start->diffInDays($end);
        if ($durasi == 0) {
            $durasi = 1;
        }

        $total_harga = $durasi * $motor->price_per_day;

        Rental::create([
            'user_id' => Auth::id(),
            'motor_id' => $motor->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $durasi,
            'total_price' => $total_harga,
            'status' => 'pending',
        ]);

        return redirect()->route('rentals.index')
            ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /*
    |--------------------------------------------------------------------------
    | Riwayat Sewa User
    |--------------------------------------------------------------------------
    */
    public function riwayat()
    {
        $rentalsAktif = Rental::with('motor')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'waiting_verification'])
            ->latest()
            ->get();

        $rentalsSelesai = Rental::with('motor')
            ->where('user_id', Auth::id())
            ->where('status', 'confirmed')
            ->latest()
            ->get();

        $rentalsBatal = Rental::with('motor')
            ->where('user_id', Auth::id())
            ->where('status', 'cancelled')
            ->latest()
            ->get();

        return view('riwayat.sewa', compact(
            'rentalsAktif',
            'rentalsSelesai',
            'rentalsBatal'
        ));
    }
}