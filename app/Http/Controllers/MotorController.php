<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    /**
     * Menampilkan halaman Home dengan data motor untuk slider.
     */
    public function home()
    {
        $motors = Motor::latest()->get(); 
        return view('home', compact('motors'));
    }

    /**
     * Menampilkan halaman Katalog khusus untuk user melakukan sewa.
     * Kode ini diletakkan di sini agar route 'katalog.index' berfungsi.
     */
    public function katalog()
    {
        // Mengambil semua data motor dari database
        $motors = Motor::all(); 
        
        // Mengarahkan ke file resources/views/katalog.blade.php
        return view('katalog', compact('motors'));
    }

    /**
     * Menampilkan katalog motor di Dashboard (untuk pencarian).
     */
    public function index(Request $request)
    {
        $query = Motor::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand', $request->brand);
        }

        $motors = $query->latest()->get();

        return view('dashboard', compact('motors'));
    }

    public function create() 
    {
        return view('motors.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|url',
            'brand' => 'required',
            'cc' => 'required|numeric',
            'type' => 'required|in:Matic,Manual,Sport',
            'price_per_day' => 'required|numeric',
        ]);

        Motor::create([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'brand' => $request->brand,
            'cc' => $request->cc,
            'type' => $request->type,
            'price_per_day' => $request->price_per_day,
        ]);

        return redirect()->route('dashboard')->with('success', 'Unit motor baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $motor = Motor::findOrFail($id);
        return view('motors.edit', compact('motor'));
    }

    public function update(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'image_url' => 'required|url',
            'brand' => 'required',
            'cc' => 'required|numeric',
            'type' => 'required|in:Matic,Manual,Sport',
            'price_per_day' => 'required|numeric',
        ]);

        $motor->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Data motor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->delete();

        return redirect()->route('dashboard')->with('success', 'Motor berhasil dihapus!');
    }
}