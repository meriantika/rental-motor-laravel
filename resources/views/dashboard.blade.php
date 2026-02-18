<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Motor - MotoRent ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Animasi halus untuk tombol aksi */
        .action-buttons {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        .motor-card:hover .action-buttons {
            opacity: 1;
            transform: translateY(0);
        }

        /* Modal Animations */
        .modal-hidden {
            display: none;
            opacity: 0;
        }
        .modal-visible {
            display: flex;
            animation: fadeIn 0.2s ease-out forwards;
        }
        .modal-content-animate {
            animation: modalIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Navbar -->
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
            <div class="text-right hidden sm:block">
                <p class="text-sm font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 font-bold uppercase mt-1 tracking-widest">Status: Admin</p>
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
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-xl">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight uppercase leading-tight">Katalog Motor</h1>
                <p class="text-slate-500 mt-2 font-medium text-lg italic">Pilih armada terbaik dari partner resmi <span class="text-blue-600 font-bold border-b-2 border-blue-100">Honda</span> & <span class="text-blue-600 font-bold border-b-2 border-blue-100">Yamaha</span>.</p>
            </div>
            <a href="{{ route('motors.create') }}" class="bg-blue-600 text-white px-10 py-5 rounded-[1.5rem] font-black uppercase tracking-widest text-sm shadow-2xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 flex items-center gap-3 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Motor Baru
            </a>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-10 p-5 bg-emerald-50 text-emerald-700 rounded-[2rem] border border-emerald-100 font-bold flex items-center justify-between gap-4 animate-in fade-in duration-500">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-500 text-white rounded-full p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    {{ session('success') }}
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Grid Katalog -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($motors as $motor)
                <div class="motor-card bg-white rounded-[3rem] border border-slate-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-100/50 transition-all duration-500 group relative">
                    
                    <!-- Admin Action Floating Buttons -->
                    <div class="action-buttons absolute top-6 right-6 z-30 flex gap-2">
                        <!-- Tombol Edit -->
                        <a href="{{ route('motors.edit', $motor->id) }}" class="bg-white p-3 rounded-2xl text-amber-500 hover:bg-amber-500 hover:text-white transition-all shadow-xl border border-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        
                        <!-- Tombol Hapus (Modified to trigger modal) -->
                        <form id="delete-form-{{ $motor->id }}" action="{{ route('motors.destroy', $motor->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" 
                                onclick="showDeleteModal('{{ $motor->id }}', '{{ $motor->name }}')"
                                class="bg-white p-3 rounded-2xl text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-xl border border-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Image Area -->
                    <div class="h-64 bg-slate-50 flex flex-col items-center justify-center relative overflow-hidden p-8">
                        @if($motor->image_url)
                            <img src="{{ $motor->image_url }}" alt="{{ $motor->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700 z-10">
                        @else
                            <span class="text-slate-200 font-black text-7xl opacity-40 uppercase tracking-tighter select-none">{{ $motor->brand }}</span>
                        @endif

                        <!-- Badges -->
                        <div class="absolute top-8 left-8 flex flex-col gap-2 z-20">
                            <span class="bg-white/90 backdrop-blur-md text-slate-900 text-[10px] px-4 py-2 rounded-full font-black uppercase tracking-widest shadow-sm border border-slate-100">
                                {{ $motor->type }}
                            </span>
                        </div>
                        
                        <div class="absolute bottom-8 right-8 bg-blue-600 text-white text-[11px] px-5 py-2.5 rounded-2xl font-black uppercase tracking-widest shadow-lg shadow-blue-200 z-20">
                            {{ $motor->cc }} CC
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="p-10">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em] mb-2 leading-none">Garansi Unit Resmi</p>
                                <h3 class="text-2xl font-black text-slate-900 leading-tight group-hover:text-blue-600 transition-colors uppercase tracking-tight">
                                    {{ $motor->name }}
                                </h3>
                            </div>
                            <div class="flex items-center gap-1.5 bg-yellow-50 px-3 py-1.5 rounded-xl border border-yellow-100 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-[11px] font-black text-yellow-700">5.0</span>
                            </div>
                        </div>

                        <!-- Price & Action -->
                        <div class="flex items-center justify-between border-t border-slate-100 pt-8 mt-4">
                            <div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1 leading-none">Mulai Dari</p>
                                <p class="text-2xl font-black text-slate-900 leading-none">
                                    <span class="text-sm font-bold text-slate-400 font-sans">Rp</span> {{ number_format($motor->price_per_day, 0, ',', '.') }}
                                    <span class="text-[10px] font-bold text-slate-400 tracking-normal italic ml-0.5">/hari</span>
                                </p>
                            </div>
                            <button class="bg-slate-900 text-white px-6 py-3.5 rounded-[1.2rem] font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition-all duration-300 shadow-xl shadow-slate-200 active:scale-90">
                                Sewa Unit
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full py-32 bg-white rounded-[3.5rem] border-2 border-dashed border-slate-100 text-center flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 uppercase tracking-tight">Katalog Masih Kosong</h3>
                    <p class="text-slate-400 font-medium mb-10 max-w-sm">Jadilah admin pertama yang mengisi garasi digital MotoRent ID dengan unit Honda & Yamaha terbaru.</p>
                    <a href="{{ route('motors.create') }}" class="text-blue-600 font-black uppercase tracking-widest text-xs hover:underline decoration-2 underline-offset-8">
                        Tambah Unit Sekarang →
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Konfirmasi Penghapusan (Custom) -->
    <div id="customDeleteModal" class="fixed inset-0 z-[100] modal-hidden items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <!-- Konten Modal -->
        <div class="relative w-full max-w-md mx-auto modal-content-animate">
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-50 mb-6">
                        <svg class="h-10 w-10 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 uppercase tracking-tight">Hapus Unit</h3>
                    <p class="text-slate-500 font-medium px-4">
                        Apakah Anda yakin ingin menghapus motor <span id="motorNamePlaceholder" class="font-bold text-slate-900"></span>? Data yang dihapus tidak dapat dipulihkan.
                    </p>
                </div>
                <div class="flex gap-3 p-8 pt-0">
                    <button onclick="closeDeleteModal()" class="flex-1 py-4 px-6 text-xs font-black uppercase tracking-widest text-slate-500 bg-slate-100 rounded-2xl hover:bg-slate-200 transition-all active:scale-95">
                        Batal
                    </button>
                    <button id="confirmDeleteBtn" class="flex-1 py-4 px-6 text-xs font-black uppercase tracking-widest text-white bg-blue-500 rounded-2xl shadow-lg shadow-red-200 hover:bg-red-600 transition-all active:scale-95">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-20 border-t bg-white py-16">
        <div class="max-w-7xl mx-auto px-10 flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="flex items-center gap-3">
                 <div class="bg-slate-900 p-2 rounded-xl text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-lg font-black text-slate-900 tracking-tighter uppercase">MotoRent ID</span>
            </div>
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] text-center md:text-left">
                © 2026 MotoRent ID • Project Rental Motor Laravel • Figma Iteration
            </p>
            <div class="flex gap-8">
                <a href="#" class="text-slate-400 hover:text-blue-600 text-[10px] font-black uppercase tracking-widest">Syarat</a>
                <a href="#" class="text-slate-400 hover:text-blue-600 text-[10px] font-black uppercase tracking-widest">Privasi</a>
            </div>
        </div>
    </footer>

    <script>
        let currentDeleteId = null;

        function showDeleteModal(id, name) {
            currentDeleteId = id;
            const modal = document.getElementById('customDeleteModal');
            const namePlaceholder = document.getElementById('motorNamePlaceholder');
            
            namePlaceholder.innerText = name;
            modal.classList.remove('modal-hidden');
            modal.classList.add('modal-visible');
            
            // Set action for confirm button
            document.getElementById('confirmDeleteBtn').onclick = function() {
                document.getElementById('delete-form-' + currentDeleteId).submit();
            };
        }

        function closeDeleteModal() {
            const modal = document.getElementById('customDeleteModal');
            modal.classList.add('modal-hidden');
            modal.classList.remove('modal-visible');
            currentDeleteId = null;
        }

        // Close modal when clicking outside content
        window.onclick = function(event) {
            const modal = document.getElementById('customDeleteModal');
            if (event.target == modal.querySelector('.fixed.inset-0.bg-slate-900\\/60')) {
                closeDeleteModal();
            }
        }
    </script>
</body>
</html>