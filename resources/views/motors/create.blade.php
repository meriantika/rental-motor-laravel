<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Unit Baru - MotoRent ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen pb-12 text-slate-900">

    <div class="max-w-2xl mx-auto pt-12 px-4">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 font-bold mb-8 hover:underline group transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Katalog
        </a>

        <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Tambah Unit Baru</h1>
                <p class="text-slate-500 font-medium mt-2 italic">Pastikan Anda memasukkan link gambar agar katalog tidak kosong.</p>
            </div>

            <form action="{{ route('motors.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Pratinjau Gambar Langsung -->
                <div id="preview-container" class="hidden mb-6">
                    <label class="block text-[10px] font-bold uppercase text-slate-400 ml-1 tracking-widest mb-2">Pratinjau Gambar</label>
                    <div class="w-full h-48 rounded-2xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-200 flex items-center justify-center">
                        <img id="image-preview" src="" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 ml-1 tracking-widest mb-2">Nama Model Motor</label>
                    <input type="text" name="name" required class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none transition shadow-sm" placeholder="Vario 160">
                </div>

                <!-- Input URL Gambar -->
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 ml-1 tracking-widest mb-2">URL/Link Gambar Motor</label>
                    <input type="text" name="image_url" id="image_url_input" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none transition shadow-sm" placeholder="Tempel link gambar (jpg/png/webp) di sini">
                    <div class="mt-3 p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <p class="text-[11px] text-blue-700 leading-relaxed font-medium">
                            <strong>Cara ambil gambar:</strong> Cari di Google Images &rarr; Klik kanan pada gambarnya &rarr; Pilih <strong>"Copy Image Address"</strong> (Salin Alamat Gambar) &rarr; Tempel di sini.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 ml-1 tracking-widest mb-2">Brand</label>
                        <select name="brand" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 transition bg-white shadow-sm appearance-none">
                            <option value="Honda">Honda</option>
                            <option value="Yamaha">Yamaha</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 ml-1 tracking-widest mb-2">CC</label>
                        <input type="number" name="cc" required class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 transition shadow-sm" placeholder="160">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 ml-1 tracking-widest mb-2">Tipe</label>
                        <select name="type" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 transition bg-white shadow-sm appearance-none">
                            <option value="Matic">Matic</option>
                            <option value="Manual">Manual</option>
                            <option value="Sport">Sport</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 ml-1 tracking-widest mb-2">Harga Sewa / Hari</label>
                        <input type="number" name="price_per_day" required class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 transition shadow-sm" placeholder="150000">
                    </div>
                </div>

                <button type="submit" class="w-full py-5 bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest text-sm rounded-2xl shadow-xl transition transform active:scale-95 shadow-blue-200">
                    Simpan Unit Sekarang
                </button>
            </form>
        </div>
    </div>

    <script>
        // Fitur Live Preview Gambar
        const inputUrl = document.getElementById('image_url_input');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('image-preview');

        inputUrl.addEventListener('input', function() {
            if (this.value) {
                previewImage.src = this.value;
                previewContainer.classList.remove('hidden');
            } else {
                previewContainer.classList.add('hidden');
            }
        });

        // Jika link error/mati, sembunyikan preview
        previewImage.onerror = function() {
            previewContainer.classList.add('hidden');
        };
    </script>

</body>
</html>