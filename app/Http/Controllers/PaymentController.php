<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental; // Pastikan ini sesuai dengan nama model Anda (Rental atau Booking)
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function uploadProof(Request $request, $id)
    {
        // 1. Validasi file
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $rental = Rental::findOrFail($id);

        // 2. Cek apakah ada file yang diunggah
        if ($request->hasFile('payment_proof')) {
            
            // Opsional: Hapus foto lama jika user upload ulang (biar storage tidak penuh)
            if ($rental->payment_proof) {
                Storage::disk('public')->delete($rental->payment_proof);
            }

            // 3. Simpan file ke storage/app/public/payments
            $path = $request->file('payment_proof')->store('payments', 'public');
            
            // 4. Update database
            $rental->update([
                'payment_proof' => $path,
                'status' => 'waiting_verification'
            ]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah!');
        }
    }
}