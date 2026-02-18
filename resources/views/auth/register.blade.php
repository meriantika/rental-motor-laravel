<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - MotoRent ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-extrabold text-slate-900">Buat Akun Baru</h1>
            <p class="text-slate-500 mt-2">Mulai langkah Anda bersama <span class="text-blue-600 font-semibold">MotoRent ID</span></p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-blue-500 transition" placeholder="Nama Anda">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-blue-500 transition" placeholder="email@contoh.com">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-blue-500 transition" placeholder="Minimal 8 karakter">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:border-blue-500 transition" placeholder="Ulangi password">
                </div>
                <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition">
                    Daftar Sekarang
                </button>
            </form>
            <div class="mt-6 text-center">
                <p class="text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk</a></p>
            </div>
        </div>
    </div>
</body>
</html>