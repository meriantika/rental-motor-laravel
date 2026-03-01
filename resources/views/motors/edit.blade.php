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

<!-- NAVBAR -->
<nav class="bg-white border-b px-8 py-5 flex justify-between items-center sticky top-0 z-50 shadow-sm">
    <div class="flex items-center gap-2">
        <a href="{{ url('/dashboard') }}"
           class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-200 hover:scale-105 transition-transform">
            ⚡
        </a>
        <span class="text-xl font-bold text-blue-600 tracking-tighter">
            MotoRent ID
        </span>
    </div>

    <div class="text-right">
        <p class="text-sm font-bold">Edit Mode</p>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">
            Administrator
        </p>
    </div>
</nav>

<div class="max-w-4xl mx-auto p-8">

    <div class="mb-8">
        <a href="{{ url('/dashboard') }}"
           class="text-slate-400 hover:text-blue-600 font-bold text-xs uppercase tracking-widest">
            ← Kembali ke Katalog
        </a>
    </div>

    <div class="bg-white rounded-[3rem] shadow-2xl border border-slate-100 overflow-hidden">

        <!-- HEADER -->
        <div class="p-10 border-b bg-slate-50">
            <h1 class="text-3xl font-black uppercase">Edit Data Unit</h1>
            <p class="text-slate-500 mt-1 italic">
                Memperbarui informasi untuk
                <span class="text-blue-600 font-bold">
                    {{ $motor->name }}
                </span>
            </p>
        </div>

        <!-- FORM -->
        <form action="{{ route('motors.update', $motor->id) }}"
              method="POST"
              class="p-10 space-y-8">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-8">

                <!-- Nama -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Nama Unit
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name',$motor->name) }}"
                           class="w-full mt-2 bg-slate-50 border rounded-2xl px-6 py-4
                                  focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                  font-bold">
                </div>

                <!-- BRAND PARTNER -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Brand Partner
                    </label>

                    <div class="relative mt-2">
                        <select name="brand"
                            class="w-full bg-slate-50 border rounded-2xl px-6 py-4
                                   focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                   font-bold appearance-none cursor-pointer pr-12">

                            <option value="Honda" {{ $motor->brand=='Honda'?'selected':'' }}>
                                Honda
                            </option>
                            <option value="Yamaha" {{ $motor->brand=='Yamaha'?'selected':'' }}>
                                Yamaha
                            </option>

                        </select>

                        <!-- Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 right-5 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- KATEGORI TIPE -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Kategori Tipe
                    </label>

                    <div class="relative mt-2">
                        <select name="type"
                            class="w-full bg-slate-50 border rounded-2xl px-6 py-4
                                   focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                   font-bold appearance-none cursor-pointer pr-12">

                            <option value="Matic" {{ $motor->type=='Matic'?'selected':'' }}>
                                Matic
                            </option>
                            <option value="Manual" {{ $motor->type=='Manual'?'selected':'' }}>
                                Manual
                            </option>
                            <option value="Sport" {{ $motor->type=='Sport'?'selected':'' }}>
                                Sport
                            </option>

                        </select>

                        <!-- Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 right-5 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- CC -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Kapasitas Mesin (CC)
                    </label>
                    <input type="number"
                           name="cc"
                           value="{{ old('cc',$motor->cc) }}"
                           class="w-full mt-2 bg-slate-50 border rounded-2xl px-6 py-4
                                  focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                  font-bold">
                </div>

                <!-- Harga -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Harga / Hari
                    </label>
                    <input type="number"
                           name="price_per_day"
                           value="{{ old('price_per_day',$motor->price_per_day) }}"
                           class="w-full mt-2 bg-slate-50 border rounded-2xl px-6 py-4
                                  focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                  font-bold">
                </div>

                <!-- URL Gambar -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        URL Gambar
                    </label>
                    <input type="text"
                           name="image_url"
                           value="{{ old('image_url',$motor->image_url) }}"
                           class="w-full mt-2 bg-slate-50 border rounded-2xl px-6 py-4
                                  focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                  font-bold text-sm">
                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-4 pt-8 border-t mt-8">

                <a href="{{ url('/dashboard') }}"
                   class="px-8 py-4 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600">
                    Batalkan
                </a>

                <button type="submit"
                        class="bg-blue-600 text-white px-10 py-5 rounded-2xl
                               font-black uppercase tracking-widest text-sm
                               shadow-xl hover:bg-blue-700 hover:-translate-y-1
                               transition-all duration-300">
                    ✓ Simpan Perubahan
                </button>

            </div>

        </form>

    </div>
</div>

</body>
</html>