<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoRent ID - Sewa Motor Jakarta Bebas Macet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .swiper-pagination-bullet-active { background: #1d4ed8 !important; }
        
        .swiper-button-next, .swiper-button-prev {
            color: #1d4ed8 !important;
            background: white;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 20;
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: #f8fafc;
            transform: scale(1.1);
        }
        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 18px !important;
            font-weight: bold;
        }
        @media (min-width: 1024px) {
            .motorSwiper { padding: 0 50px; }
        }
    </style>
</head>
<body class="bg-white text-slate-900">

    <nav class="absolute top-0 left-0 right-0 z-50 px-6 py-6 lg:px-16">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <div class="bg-[#ffc107] p-2 rounded-lg shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-2xl font-black text-white tracking-tighter uppercase">MotoRent <span class="text-[#ffc107]">ID</span></span>
            </a>
            <div class="hidden lg:flex items-center gap-8 text-white">
                @auth
                    <a href="{{ route('dashboard') }}" class="font-bold hover:text-[#ffc107] transition-colors">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500/20 text-red-100 px-6 py-2 rounded-xl font-bold hover:bg-red-500 transition-all border border-red-500/50">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-bold hover:text-[#ffc107] transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-white text-blue-700 px-6 py-2 rounded-xl font-bold hover:bg-[#ffc107] hover:text-slate-900 transition-all shadow-lg">Daftar Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="relative bg-blue-700 min-h-screen flex items-center overflow-hidden">
        <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-blue-600 rounded-full opacity-50"></div>
        <div class="container mx-auto px-6 lg:px-16 grid lg:grid-cols-2 gap-12 items-center relative z-10 pt-20 text-center lg:text-left">
            <div class="text-white">
                <p class="text-lg font-medium mb-2 opacity-90 tracking-wide uppercase">Sewa Motor Murah Jakarta</p>
                <h1 class="text-5xl lg:text-7xl font-extrabold mb-6 leading-tight tracking-tight text-[#ffc107]">MotoRent ID: <br> Solusi Bebas Macet!</h1>
                <p class="text-lg mb-10 opacity-90 max-w-lg leading-relaxed mx-auto lg:mx-0">
                    Sewa motor praktis di Jakarta dengan harga kompetitif. Tembus kemacetan ibu kota dengan armada terbaru dan terawat dari kami!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('dashboard') }}" class="bg-[#ffc107] text-slate-900 px-8 py-4 rounded-xl font-bold flex items-center justify-center gap-3 hover:bg-yellow-500 transition-all shadow-xl active:scale-95 group">Sewa Sekarang</a>
                    <a href="https://wa.me/628123456789" target="_blank" class="bg-white/10 backdrop-blur-md text-white border-2 border-white/30 px-8 py-4 rounded-xl font-bold flex items-center justify-center gap-3 hover:bg-white hover:text-blue-700 transition-all">Hubungi Kami</a>
                </div>
            </div>
            <div class="relative hidden lg:flex justify-center items-center">
                <div class="relative z-20 w-80 h-80 lg:w-[450px] lg:h-[450px] border-8 border-[#ffc107] rounded-full overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Monas">
                </div>
                <div class="absolute -bottom-10 -left-10 z-30 w-48 h-48 lg:w-64 lg:h-64 border-4 border-white rounded-full overflow-hidden shadow-2xl transition-all hover:-translate-y-2">
                    <img src="https://asset.kompas.com/crops/-1qaDzh3KDPknMv6aHax-7tHXGg=/0x0:1000x667/1200x800/data/photo/2022/06/17/62ac673f71587.jpg" alt="Jakarta City" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-6 relative"> 
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-black uppercase tracking-tight text-slate-900">Pilihan Armada Terbaik</h2>
                <div class="h-1.5 w-24 bg-[#ffc107] mx-auto mt-4 rounded-full"></div>
            </div>

            @if($motors->isEmpty())
                <p class="text-center text-slate-400 italic">Belum ada armada tersedia saat ini.</p>
            @else
                <div class="swiper motorSwiper pb-12 overflow-hidden lg:overflow-visible">
                    <div class="swiper-wrapper">
                        @foreach($motors as $motor)
                        <div class="swiper-slide h-auto">
                            <div class="bg-white h-full rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition-all flex flex-col mx-2">
                                <div class="h-48 flex items-center justify-center mb-6">
                                    <img src="{{ $motor->image_url }}" class="max-h-full object-contain" alt="{{ $motor->name }}">
                                </div>
                                <h3 class="text-xl font-extrabold uppercase mb-2 text-slate-900 text-center">{{ $motor->name }}</h3>
                                <p class="text-blue-600 font-bold mb-6 italic text-center">Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}/hari</p>
                                <div class="mt-auto">
                                    <a href="{{ route('dashboard') }}" class="block w-full text-center bg-slate-900 text-white py-3 rounded-2xl font-bold hover:bg-blue-600 transition-colors">Pesan Unit</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next !hidden lg:!flex"></div>
                    <div class="swiper-button-prev !hidden lg:!flex"></div>
                    <div class="swiper-pagination !static mt-10"></div>
                </div>
            @endif
        </div>
    </section>

    <footer class="bg-slate-900 text-white pt-20 pb-10">
        <div class="container mx-auto px-6 lg:px-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="space-y-6">
                <a href="/" class="flex items-center gap-2">
                    <div class="bg-[#ffc107] p-2 rounded-lg shadow-lg text-slate-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-black tracking-tighter uppercase text-white">MotoRent <span class="text-[#ffc107]">ID</span></span>
                </a>
                <p class="text-slate-400">Layanan sewa motor terpercaya di Jakarta. Solusi mobilitas cepat, murah, dan bebas macet.</p>
                <div class="space-y-3 text-slate-400">
                    <p class="flex items-center gap-3">
                        <span class="text-[#ffc107]">📍</span> Jl. Sudirman No. 123, Jakarta Pusat
                    </p>
                    <p class="flex items-center gap-3">
                        <span class="text-[#ffc107]">📞</span> +62 812-3456-789
                    </p>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-6 border-l-4 border-[#ffc107] pl-4 uppercase">Navigasi</h4>
                <ul class="space-y-4 text-slate-400">
                    <li><a href="/" class="hover:text-[#ffc107] transition-colors">Beranda</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-[#ffc107] transition-colors">Cek Katalog</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-[#ffc107] transition-colors">Masuk Akun</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-6 border-l-4 border-[#ffc107] pl-4 uppercase">Jam Operasional</h4>
                <ul class="space-y-4 text-slate-400">
                    <li class="flex justify-between"><span>Senin - Jumat</span> <span>08:00 - 20:00</span></li>
                    <li class="flex justify-between"><span>Sabtu</span> <span>09:00 - 18:00</span></li>
                    <li class="flex justify-between text-red-400"><span>Minggu</span> <span>Tutup</span></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-6 border-l-4 border-[#ffc107] pl-4 uppercase">Ikuti Kami</h4>
                <div class="flex gap-4">
                    <a href="#" class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-[#1877F2] transition-all shadow-lg group">
                        <svg class="h-6 w-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>

                    <a href="#" class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-gradient-to-tr hover:from-[#f9ce34] hover:via-[#ee2a7b] hover:to-[#6228d7] transition-all shadow-lg group">
                        <svg class="h-6 w-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.849-.07c-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849s.012-3.584.07-4.849c.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>

                    <a href="#" class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-black transition-all shadow-lg group">
                        <svg class="h-5 w-5 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                </div>
                <p class="mt-6 text-slate-400 text-sm italic">"Keamanan & Kenyamanan adalah Prioritas Kami"</p>
            </div>
        </div>

        <div class="container mx-auto px-6 mt-16 pt-8 border-t border-slate-800 text-center">
            <p class="text-slate-500 text-sm italic">
                © 2026 <span class="text-white font-bold tracking-tighter">MotoRent <span class="text-[#ffc107]">ID</span></span>. All rights reserved. 
                Dibuat dengan ❤️ di Jakarta.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".motorSwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                grabCursor: true,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 25 },
                },
            });
        });
    </script>
</body>
</html>