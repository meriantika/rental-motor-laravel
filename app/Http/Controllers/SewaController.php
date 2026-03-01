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
            })
            ->when($request->brand, function ($query, $brand) {
                return $query->where('brand', $brand);
            })
            ->paginate(6)
            ->withQueryString();

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
            'end_date'   => 'required|date|after:start_date',
        ]);

        $motor = Motor::findOrFail($id);

        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        $durasi = $start->diffInDays($end);
        if ($durasi == 0) {
            $durasi = 1;
        }

        $total_harga = $durasi * $motor->price_per_day;

        Rental::create([
            'user_id'     => Auth::id(),
            'motor_id'    => $motor->id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'total_days'  => $durasi,
            'total_price' => $total_harga,
            'status'      => 'pending',
        ]);

        return redirect()->route('rentals.index')
            ->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi admin.');
    }

    /*
    |--------------------------------------------------------------------------
    | Konfirmasi Sewa (USER)
    |--------------------------------------------------------------------------
    */
    /*
|--------------------------------------------------------------------------
| Konfirmasi Sewa (USER -> WA ADMIN)
|--------------------------------------------------------------------------
*/
    public function confirm($id)
    {
        $sewa = Rental::with('motor')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($sewa->status == 'pending') {

            // Ubah status jadi menunggu verifikasi admin
            $sewa->update([
                'status' => 'waiting_verification'
            ]);
        }

        // Nomor admin (GANTI dengan nomor WA kamu)
        $adminNumber = '6282179919001';

        $message = urlencode(
            "Halo Admin MotoRent ID,\n\n".
            "Saya ingin konfirmasi pembayaran:\n".
            "Motor: {$sewa->motor->name}\n".
            "Tanggal: {$sewa->start_date} - {$sewa->end_date}\n".
            "Total: Rp ".number_format($sewa->total_price,0,',','.')."\n\n".
            "Mohon verifikasi ya."
        );

        return redirect("https://wa.me/{$adminNumber}?text={$message}");
    }

    /*
    |--------------------------------------------------------------------------
    | Batalkan Sewa (USER)
    |--------------------------------------------------------------------------
    */
    public function cancel($id)
    {
        $sewa = Rental::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($sewa->status == 'pending') {
            $sewa->update([
                'status' => 'cancelled'
            ]);
        }

        return back()->with('success', 'Penyewaan berhasil dibatalkan.');
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

    /*
    |--------------------------------------------------------------------------
    | ================= ADMIN AREA =================
    |--------------------------------------------------------------------------
    */

    public function adminIndex(Request $request)
    {
        $rentals = Rental::with(['motor', 'user'])
            ->when($request->search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistik
        $totalTransaksi = Rental::count();
        $totalPending = Rental::where('status', 'waiting_verification')->count();
        $totalPendapatan = Rental::where('status', 'confirmed')->sum('total_price');

        return view('admin.rentals.index', compact(
            'rentals',
            'totalTransaksi',
            'totalPending',
            'totalPendapatan'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Status (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function updateStatus(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);

        $rental->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }
}