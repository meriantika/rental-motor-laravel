<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Unit - MotoRent ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Navbar -->
    <nav class="bg-white border-b px-8 py-5 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-2">
            <!-- Diarahkan ke /dashboard sesuai URL di browser Anda -->
            <a href="{{ url('/dashboard') }}" class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-200 hover:scale-105 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </a>
            <span class="text-xl font-bold text-blue-600 tracking-tighter">MotoRent ID</span>
        </div>
        <div class="text-right">
            <p class="text-sm font-bold text-slate-900 leading-none">Edit Mode</p>
            <p class="text-[10px] text-slate-500 font-bold uppercase mt-1 tracking-widest">Administrator</p>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto p-8">
        <!-- Breadcrumbs & Kembali -->
        <div class="mb-8">
            <a href="{{ url('/dashboard') }}" class="inline-flex items-center text-slate-400 hover:text-blue-600 font-bold text-xs uppercase tracking-widest gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Katalog
            </a>
        </div>

        <!-- Kartu Form -->
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-blue-100/20 border border-slate-100 overflow-hidden">
            <div class="p-10 border-b border-slate-50 bg-slate-50/50">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight uppercase leading-tight">Edit Data Unit</h1>
                <p class="text-slate-500 mt-1 font-medium italic">Memperbarui informasi untuk <span class="text-blue-600 font-bold">{{ $motor->name }}</span></p>
            </div>

            <form action="{{ route('motors.update', $motor->id) }}" method="POST" class="p-10 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nama Motor -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Nama Unit</label>
                        <input type="text" name="name" value="{{ old('name', $motor->name) }}" 
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-slate-900"
                            placeholder="Contoh: Honda Vario 160">
                    </div>

                    <!-- Brand -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Brand Partner</label>
                        <select name="brand" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-slate-900 appearance-none">
                            <option value="Honda" {{ $motor->brand == 'Honda' ? 'selected' : '' }}>Honda</option>
                            <option value="Yamaha" {{ $motor->brand == 'Yamaha' ? 'selected' : '' }}>Yamaha</option>
                        </select>
                    </div>

                    <!-- Tipe -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Kategori Tipe</label>
                        <input type="text" name="type" value="{{ old('type', $motor->type) }}" 
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-slate-900"
                            placeholder="Contoh: MATIC">
                    </div>

                    <!-- CC -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Kapasitas Mesin (CC)</label>
                        <input type="number" name="cc" value="{{ old('cc', $motor->cc) }}" 
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-slate-900"
                            placeholder="Contoh: 155">
                    </div>

                    <!-- Harga per Hari -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Harga Sewa / Hari (Rp)</label>
                        <input type="number" name="price_per_day" value="{{ old('price_per_day', $motor->price_per_day) }}" 
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-slate-900"
                            placeholder="Contoh: 150000">
                    </div>

                    <!-- URL Gambar -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">URL Gambar Unit</label>
                        <input type="text" name="image_url" value="{{ old('image_url', $motor->image_url) }}" 
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-slate-900 text-sm"
                            placeholder="https://link-gambar.com/motor.png">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-50 mt-10">
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-all">
                        Batalkan Perubahan
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-10 py-5 rounded-[1.5rem] font-black uppercase tracking-widest text-sm shadow-2xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 active:scale-95 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-20 border-t bg-white py-16">
        <div class="max-w-7xl mx-auto px-10 text-center">
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em]">
                © 2026 MotoRent ID • Sesi Mode Edit
            </p>
        </div>
    </footer>
</body>
</html>