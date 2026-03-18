<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Brand;
use App\Models\Review;
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
     */
    public function katalog()
    {
        $motors = Motor::with('brand')->get(); 
        return view('katalog', compact('motors'));
    }

    /**
     * Menampilkan katalog motor di Dashboard (untuk pencarian).
     */
    public function index(Request $request)
    {
        $brands = Brand::all();

        $motors = Motor::with('brand')
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->brand, function ($q) use ($request) {
                $q->where('brand_id', $request->brand);
            })
            ->when($request->min_price, function ($q) use ($request) {
                $q->where('price_per_day', '>=', $request->min_price);
            })
            ->when($request->max_price, function ($q) use ($request) {
                $q->where('price_per_day', '<=', $request->max_price);
            })
            ->latest()
            ->paginate(3)
            ->withQueryString();

        return view('dashboard', compact('motors','brands'));
    }

    /**
     * Menampilkan detail motor
     */
    public function show($id)
    {
    $motor = Motor::findOrFail($id);

    $reviews = Review::where('motor_id', $id)
        ->with('user')
        ->latest()
        ->paginate(5); // tampil 5 ulasan per halaman

    return view('motors.show', compact('motor','reviews'));
    }

    /**
     * FORM TAMBAH MOTOR
     */
    public function create()
    {
        $brands = Brand::all();

        return view('motors.create', compact('brands'));
    }

    /**
     * SIMPAN MOTOR
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|url',
            'brand_id' => 'required',
            'cc' => 'required|numeric',
            'type' => 'required|in:Matic,Manual,Sport',
            'price_per_day' => 'required|numeric',
        ]);

        Motor::create([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'brand_id' => $request->brand_id,
            'cc' => $request->cc,
            'type' => $request->type,
            'price_per_day' => $request->price_per_day,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Unit motor baru berhasil ditambahkan!');
    }

    /**
     * FORM EDIT MOTOR
     */
    public function edit($id)
    {
        $motor = Motor::findOrFail($id);
        $brands = Brand::all();

        return view('motors.edit', compact('motor','brands'));
    }

    /**
     * UPDATE MOTOR
     */
    public function update(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'image_url' => 'required|url',
            'brand_id' => 'required',
            'cc' => 'required|numeric',
            'type' => 'required|in:Matic,Manual,Sport',
            'price_per_day' => 'required|numeric',
        ]);

        $motor->update([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'brand_id' => $request->brand_id,
            'cc' => $request->cc,
            'type' => $request->type,
            'price_per_day' => $request->price_per_day,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Data motor berhasil diperbarui!');
    }

    /**
     * HAPUS MOTOR
     */
    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Motor berhasil dihapus!');
    }
}