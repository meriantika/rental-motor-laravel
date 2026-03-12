<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::all();

        return view('admin.brands.index', compact('brands'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Brand::create([
            'name' => $request->name
        ]);

        return back()->with('success','Brand berhasil ditambahkan');
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return back()->with('success','Brand berhasil dihapus');
    }

}