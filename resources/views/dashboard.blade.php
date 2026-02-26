<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Motor - MotoRent ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .action-buttons {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        .motor-card:hover .action-buttons {
            opacity: 1;
            transform: translateY(0);
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .animate-fadeIn { animation: fadeIn 0.5s ease-out forwards; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <nav class="bg-white border-b px-8 py-5 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-2">
            <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span class="text-xl font-bold text-blue-600 tracking-tighter">MotoRent ID</span>
        </div>

        <div class="flex items-center gap-6">
            @if(Auth::user()->role == 'user')
                <a href="{{ route('rentals.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-blue-600 transition-all">
                    Riwayat Sewa
                </a>
            @elseif(Auth::user()->role == 'admin')
                <a href="{{ route('admin.rentals.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-blue-600 transition-all">
                    Kelola Transaksi
                </a>
            @endif

            <div class="text-right hidden sm:block border-l pl-6 border-slate-100">
                <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 font-bold uppercase mt-1 tracking-widest italic leading-none">
                    Status: {{ Auth::user()->role }}
                </p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-50 text-red-600 px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-red-100 transition duration-300">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-8">
        <div class="flex flex-col md:flex-row justify-between items-start mb-12 gap-8">
            <div class="max-w-xl">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight uppercase leading-tight">Katalog Motor</h1>
                <p class="text-slate-500 mt-2 font-medium text-lg italic">Pilih armada terbaik dari partner resmi <span class="text-blue-600 font-bold border-b-2 border-blue-100">Honda</span> & <span class="text-blue-600 font-bold border-b-2 border-blue-100">Yamaha</span>.</p>
            </div>

            @if(Auth::user()->role == 'admin')
            <a href="{{ route('motors.create') }}" class="bg-blue-600 text-white px-10 py-5 rounded-[1.5rem] font-black uppercase tracking-widest text-sm shadow-2xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 flex items-center gap-3 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Motor Baru
            </a>
            @endif
        </div>

        <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm mb-12">
            <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama motor (ex: NMAX)..." 
                        class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-blue-500 font-medium text-sm">
                </div>
                <div class="md:w-48">
                    <select name="brand" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-blue-500 font-bold text-slate-500 appearance-none text-sm">
                        <option value="">Semua Merk</option>
                        <option value="Honda" {{ request('brand') == 'Honda' ? 'selected' : '' }}>Honda</option>
                        <option value="Yamaha" {{ request('brand') == 'Yamaha' ? 'selected' : '' }}>Yamaha</option>
                    </select>
                </div>
                <button type="submit" class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-blue-600 transition-all shadow-lg active:scale-95">
                    Cari Armada
                </button>
                @if(request('search') || request('brand'))
                    <a href="{{ route('dashboard') }}" class="bg-slate-100 text-slate-500 px-6 py-4 rounded-2xl font-bold text-xs flex items-center justify-center hover:bg-slate-200 transition-all">Reset</a>
                @endif
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($motors as $motor)
                <div class="motor-card bg-white rounded-[3rem] border border-slate-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-100/50 transition-all duration-500 group relative">
                    
                    @if(Auth::user()->role == 'admin')
                    <div class="action-buttons absolute top-6 right-6 z-30 flex gap-2">
                        <a href="{{ route('motors.edit', $motor->id) }}" class="bg-white p-3 rounded-2xl text-amber-500 hover:bg-amber-500 hover:text-white transition-all shadow-xl border border-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </a>
                        <form id="delete-form-{{ $motor->id }}" action="{{ route('motors.destroy', $motor->id) }}" method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                        <button type="button" onclick="confirmDelete('{{ $motor->id }}')" class="bg-white p-3 rounded-2xl text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-xl border border-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>
                    @endif
                    
                    <div class="h-64 bg-slate-50 flex flex-col items-center justify-center relative overflow-hidden p-8">
                        @if($motor->image_url)
                            <img src="{{ $motor->image_url }}" alt="{{ $motor->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700 z-10">
                        @else
                            <span class="text-slate-200 font-black text-7xl opacity-40 uppercase tracking-tighter select-none">{{ $motor->brand }}</span>
                        @endif

                        <div class="absolute top-8 left-8 flex flex-col gap-2 z-20">
                            <span class="bg-white/90 backdrop-blur-md text-slate-900 text-[10px] px-4 py-2 rounded-full font-black uppercase tracking-widest shadow-sm border border-slate-100">
                                {{ $motor->type }}
                            </span>
                        </div>
                        
                        <div class="absolute bottom-8 right-8 bg-blue-600 text-white text-[11px] px-5 py-2.5 rounded-2xl font-black uppercase tracking-widest shadow-lg shadow-blue-200 z-20">
                            {{ $motor->cc }} CC
                        </div>
                    </div>

                    <div class="p-10">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em] mb-2 leading-none">Garansi Unit Resmi</p>
                                <h3 class="text-2xl font-black text-slate-900 leading-tight group-hover:text-blue-600 transition-colors uppercase tracking-tight">
                                    {{ $motor->name }}
                                </h3>
                            </div>
                            <div class="flex items-center gap-1.5 bg-yellow-50 px-3 py-1.5 rounded-xl border border-yellow-100 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <span class="text-[11px] font-black text-yellow-700">5.0</span>
                            </div>
                        </div>

                        <div class="flex flex-col border-t border-slate-100 pt-8 mt-4">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1 leading-none">Mulai Dari</p>
                                    <p class="text-2xl font-black text-slate-900 leading-none">
                                        <span class="text-sm font-bold text-slate-400 font-sans">Rp</span> {{ number_format($motor->price_per_day, 0, ',', '.') }}
                                    </p>
                                </div>
                                @if(Auth::user()->role == 'admin')
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Admin Mode</span>
                                @endif
                            </div>

                            @if(Auth::user()->role == 'user')
                                <form action="{{ route('sewa.store', $motor->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <div class="grid grid-cols-2 gap-2 mb-4">
                                        <div class="flex flex-col gap-1">
                                            <label class="text-[8px] font-bold text-slate-400 uppercase ml-1">Tgl Mulai</label>
                                            <input type="date" name="start_date" class="text-[10px] p-2.5 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-bold text-slate-600" required min="{{ date('Y-m-d') }}">
                                        </div>
                                        <div class="flex flex-col gap-1">
                                            <label class="text-[8px] font-bold text-slate-400 uppercase ml-1">Tgl Selesai</label>
                                            <input type="date" name="end_date" class="text-[10px] p-2.5 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none font-bold text-slate-600" required min="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full bg-slate-900 text-white px-6 py-4 rounded-[1.2rem] font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition-all duration-300 shadow-xl shadow-slate-200 active:scale-95">
                                        Konfirmasi Sewa
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center">
                    <div class="bg-white p-12 rounded-[3rem] border border-dashed border-slate-200 inline-block">
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">Tidak ada unit motor yang sesuai pencarian.</p>
                        <a href="{{ route('dashboard') }}" class="text-blue-600 text-[10px] font-black uppercase mt-4 block hover:underline tracking-widest">Lihat Semua Unit</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin Ingin Menghapus?',
                text: "Data motor yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb', // Warna biru MotoRent
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus Unit!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        // Tampilkan notifikasi sukses jika ada session success
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000,
                customClass: { popup: 'rounded-[2rem]' }
            });
        @endif
    </script>
</body>
</html>