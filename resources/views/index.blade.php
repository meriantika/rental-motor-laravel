<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ED.Rent - Rental Motor Cepat & Aman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-white">

    <section class="flex flex-col md:flex-row min-h-[85vh] items-stretch">
        <div class="w-full md:w-1/2 p-10 lg:p-24 flex flex-col justify-center">
            <h1 class="text-6xl font-extrabold text-blue-600 mb-2">ED.Rent</h1>
            <h2 class="text-3xl font-bold mb-8 text-gray-800">Website + Dashboard</h2>
            <div class="max-w-md text-gray-500 text-lg leading-relaxed mb-12">
                Platform rental motor tercepat dan aman untuk kebutuhan harian, liburan, dan kerja.
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-xs">e</div>
                    <span class="font-bold text-xl text-gray-800">eduwork</span>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 relative bg-gray-200">
            <img src="{{ asset('images/rental-motor.jpeg') }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 flex items-center p-12">
                <h3 class="text-white text-5xl font-bold leading-tight">
                    Rental Motor <br> Cepat & Aman, <br> Mulai Rp75.000/ <br> hari
                </h3>
            </div>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 -mt-16 relative z-30">
        <form action="/" method="GET" class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100 flex flex-wrap md:flex-nowrap items-end gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Cari Motor</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: NMAX..." class="w-full bg-gray-50 border rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div class="w-full md:w-48">
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Durasi Sewa</label>
                <select class="w-full bg-gray-50 border rounded-xl py-3 px-4 outline-none font-semibold text-gray-700">
                    <option>1 Hari</option>
                    <option>3 Hari</option>
                    <option>7 Hari</option>
                    <option>30 Hari</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-3 rounded-xl transition shadow-lg shadow-blue-200">Cari</button>
        </form>
    </div>

    <section id="list-motor" class="py-20 px-10 lg:px-24 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-12">
                <h3 class="text-3xl font-extrabold text-gray-900">Pilihan Motor</h3>
                <a href="/motor/create" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700">+ Tambah Motor</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse ($motors as $motor)
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all group">
                        <div class="h-60 bg-gray-100 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $motor->gambar) }}" alt="{{ $motor->nama_motor }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-blue-600 uppercase">{{ $motor->brand }}</span>
                        </div>
                        <div class="p-8">
                            <h4 class="text-2xl font-bold text-gray-800">{{ $motor->nama_motor }}</h4>
                            <div class="mt-6 flex justify-between items-center">
                                <div>
                                    <p class="text-orange-500 text-2xl font-black">Rp {{ number_format($motor->harga_per_hari, 0, ',', '.') }}</p>
                                    <span class="text-gray-400 text-sm">/ hari</span>
                                </div>
                                <button class="bg-orange-500 text-white font-bold px-6 py-3 rounded-xl hover:bg-orange-600 transition">Sewa</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-3xl border-2 border-dashed">
                        <p class="text-gray-400 italic">Belum ada motor yang di-input ke katalog.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</body>
</html>