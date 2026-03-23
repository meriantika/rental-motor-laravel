<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan Form Login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses Login
     * Menangani autentikasi dan pengalihan berdasarkan role.
     */
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Mencoba Autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role user untuk menentukan arah redirect
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Selamat datang kembali, Admin!');
            }

            // Jika User biasa
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang di MotoRent ID!');
        }

        // 3. Jika gagal login
        return back()->with('error', 'Email atau password salah.')->withInput($request->only('email'));
    }

    /**
     * Menampilkan Form Register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses Pendaftaran Akun Baru
     */
    public function register(Request $request)
    {
        dd($request->all());
        
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat! Silakan login untuk mulai menyewa.');
    }


    /**
     * Menyimpan Data Profil Penyewa
     */
    public function saveProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'nik' => 'required',
            'address' => 'required'
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'address' => $request->address
        ]);

        return redirect()->route('dashboard')
            ->with('success','Data penyewa berhasil disimpan');
    }


    /**
     * Proses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}