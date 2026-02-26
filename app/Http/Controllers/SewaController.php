<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\Rental; // GANTI: Sebelumnya Sewa
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SewaController extends Controller
{
    public function index(Request $request)
    {
        $motors = Motor::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('dashboard', compact('motors'));
    }

    public function store(Request $request, $id)
    {
        // 1. Validasi Input Tanggal
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        // 2. Ambil data motor berdasarkan ID
        $motor = Motor::findOrFail($id);

        // 3. Hitung Durasi Sewa (Selisih Hari)
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $durasi = $start->diffInDays($end);

        if ($durasi == 0) $durasi = 1;

        // 4. Hitung Total Harga
        $total_harga = $durasi * $motor->price_per_day;

        // 5. Simpan ke Database (NAMA KOLOM DISESUAIKAN DENGAN MIGRASI)
        $sewa = new Rental(); 
        $sewa->user_id = Auth::id();
        $sewa->motor_id = $motor->id;
        $sewa->start_date = $request->start_date; // Sesuai migrasi
        $sewa->end_date = $request->end_date;     // Sesuai migrasi
        $sewa->total_days = $durasi;              // Sesuai migrasi
        $sewa->total_price = $total_harga;        // Sesuai migrasi
        $sewa->status = 'pending';                // Sesuai migrasi
        $sewa->save();

        // 6. Redirect ke halaman riwayat
        return redirect()->route('rentals.index')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }
    
    public function riwayat()
    {
        // Pastikan di sini juga menggunakan Rental
        $rentals = Rental::where('user_id', Auth::id())->latest()->get();
        return view('riwayat', compact('rentals'));
    }
}