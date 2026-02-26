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
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali, Admin!');
            }

            // Jika User biasa, diarahkan ke katalog agar tidak 404
            return redirect()->intended('/katalog')->with('success', 'Selamat datang di MotoRent ID!');
        }

        // 3. Jika gagal login, kirim pesan error session
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
     * Proses Pendaftaran Akun Baru (Handle Register)
     */
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', 
        ]);

        // 2. Simpan ke Database dengan role default 'user'
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        // 3. Redirect ke halaman login dengan mengirim SESSION SUKSES
        // Pesan ini akan ditangkap oleh komponen alert di view login
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login untuk mulai menyewa.');
    }

    /**
     * Proses Logout
     * Menghapus session secara menyeluruh demi keamanan.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}