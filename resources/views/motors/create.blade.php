<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Unit - MotoRent ID</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

<div class="max-w-3xl mx-auto p-8">

    <div class="bg-white rounded-[3rem] shadow-2xl border border-slate-100 overflow-hidden">

        <!-- HEADER -->
        <div class="p-10 border-b bg-slate-50">
            <h1 class="text-3xl font-black uppercase">Tambah Unit Baru</h1>
            <p class="text-slate-500 mt-1 italic">
                Pastikan Anda memasukkan link gambar agar katalog tidak kosong.
            </p>
        </div>

        <!-- FORM -->
        <form action="{{ route('motors.store') }}"
              method="POST"
              class="p-10 space-y-8">

            @csrf

            <!-- Nama -->
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                    Nama Model Motor
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="w-full mt-2 bg-slate-50 border rounded-2xl px-6 py-4
                              focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                              font-bold"
                       placeholder="Contoh: Vario 160">
            </div>

            <!-- URL Gambar -->
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                    URL / Link Gambar Motor
                </label>
                <input type="text"
                       name="image_url"
                       value="{{ old('image_url') }}"
                       class="w-full mt-2 bg-slate-50 border rounded-2xl px-6 py-4
                              focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                              font-bold text-sm"
                       placeholder="Tempel link gambar di sini">
            </div>

            <div class="grid md:grid-cols-2 gap-8">

                <!-- BRAND -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Brand
                    </label>

                    <div class="relative mt-2">
                        <select name="brand"
                            class="w-full bg-slate-50 border rounded-2xl px-6 py-4
                                   focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                   font-bold appearance-none cursor-pointer pr-12">

                            <option value="">Pilih Brand</option>
                            <option value="Honda">Honda</option>
                            <option value="Yamaha">Yamaha</option>

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
                        CC
                    </label>
                    <input type="number"
                           name="cc"
                           value="{{ old('cc') }}"
                           class="w-full mt-2 bg-slate-50 border rounded-2xl px-6 py-4
                                  focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                  font-bold"
                           placeholder="Contoh: 160">
                </div>

                <!-- TIPE -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Tipe
                    </label>

                    <div class="relative mt-2">
                        <select name="type"
                            class="w-full bg-slate-50 border rounded-2xl px-6 py-4
                                   focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                   font-bold appearance-none cursor-pointer pr-12">

                            <option value="">Pilih Tipe</option>
                            <option value="Matic">Matic</option>
                            <option value="Manual">Manual</option>
                            <option value="Sport">Sport</option>

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

                <!-- Harga -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Harga Sewa / Hari
                    </label>
                    <input type="number"
                           name="price_per_day"
                           value="{{ old('price_per_day') }}"
                           class="w-full mt-2 bg-slate-50 border rounded-2xl px-6 py-4
                                  focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                  font-bold"
                           placeholder="Contoh: 150000">
                </div>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-5 rounded-2xl
                           font-black uppercase tracking-widest text-sm
                           shadow-xl hover:bg-blue-700 hover:-translate-y-1
                           transition-all duration-300">
                Simpan Unit Sekarang
            </button>

        </form>

    </div>

</div>

</body>
</html>