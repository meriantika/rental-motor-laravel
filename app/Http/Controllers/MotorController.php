<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function index()
    {
        $motors = Motor::all();
        return view('dashboard', compact('motors'));
    }

    public function create()
    {
        return view('motors.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'cc' => 'required|numeric',
            'price_per_day' => 'required|numeric',
        ]);

        // Simpan ke database
        Motor::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Motor berhasil ditambahkan ke katalog!');
    }

    public function edit(Motor $motor)
    {
        // Menggunakan Route Model Binding (Motor $motor) secara otomatis mencari ID yang sesuai
        return view('motors.edit', compact('motor'));
    }

    /**
     * Memperbarui data motor di database.
     */
    public function update(Request $request, Motor $motor)
    {
        // Validasi data (sama seperti store)
        $request->validate([
            'name'          => 'required|string|max:255',
            'brand'         => 'required|string',
            'type'          => 'required|string',
            'cc'            => 'required|numeric',
            'price_per_day' => 'required|numeric',
            'image_url'     => 'nullable|url',
        ]);

        // Update data di database
        $motor->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Data motor berhasil diperbarui!');
    }

    /**
     * Menghapus data motor dari database.
     */
    public function destroy(Motor $motor)
    {
        // Hapus data dari database
        $motor->delete();

        // Kembali ke halaman dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Motor berhasil dihapus dari katalog!');
    }
}