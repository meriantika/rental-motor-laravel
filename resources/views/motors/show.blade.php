<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Motor - MotoRent ID</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50">

<div class="max-w-6xl mx-auto p-10">

    {{-- Kembali ke katalog --}}
    <a href="{{ route('dashboard') }}"
        class="text-blue-600 font-semibold hover:underline">
        ← Kembali ke Katalog
    </a>


    <div class="grid md:grid-cols-2 gap-12 mt-6">

        {{-- ================= GAMBAR MOTOR ================= --}}
        <div class="bg-white rounded-3xl shadow p-10">

            @if($motor->image_url)
                <img src="{{ $motor->image_url }}"
                    class="w-full object-contain">
            @else
                <div class="h-72 flex items-center justify-center text-slate-300 text-4xl font-bold">
                    {{ $motor->brand }}
                </div>
            @endif

        </div>


        {{-- ================= INFO MOTOR ================= --}}
        <div>

            <h1 class="text-3xl font-black mb-2">
                {{ $motor->name }}
            </h1>

            <p class="text-slate-500 mb-3">
                {{ $motor->cc }} CC • {{ $motor->brand }}
            </p>


            {{-- BADGE TERLARIS --}}
            @if($motor->reviews->count() >= 3)
                <span class="bg-orange-500 text-white text-xs px-3 py-1 rounded-full font-bold">
                    🔥 Motor Terlaris
                </span>
            @endif


            {{-- RATING --}}
            @php
                $rating = $motor->reviews->avg('rating');
            @endphp

            @if($rating)
                <p class="text-yellow-500 font-semibold mt-3">
                    ⭐ {{ number_format($rating,1) }} / 5
                    <span class="text-slate-400 text-sm">
                        ({{ $motor->reviews->count() }} ulasan)
                    </span>
                </p>
            @endif


            {{-- HARGA --}}
            <p class="text-3xl font-bold text-blue-600 mt-5 mb-6">
                Rp {{ number_format($motor->price_per_day,0,',','.') }} / hari
            </p>


            {{-- ================= BOOKING ================= --}}
            <form action="{{ route('sewa.store', $motor->id) }}"
                method="POST"
                class="space-y-4">

                @csrf

                <input type="date"
                    name="start_date"
                    required
                    min="{{ date('Y-m-d') }}"
                    class="w-full border rounded-xl px-4 py-3">

                <input type="date"
                    name="end_date"
                    required
                    min="{{ date('Y-m-d') }}"
                    class="w-full border rounded-xl px-4 py-3">

                <button
                    class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">
                    Sewa Sekarang
                </button>

            </form>


            {{-- ================= DESKRIPSI ================= --}}
            <div class="mt-10">

                <h3 class="font-bold text-lg mb-2">
                    Deskripsi Motor
                </h3>

                <p class="text-slate-600 leading-relaxed">
                    Motor {{ $motor->name }} merupakan pilihan yang nyaman untuk perjalanan
                    harian maupun wisata. Dengan mesin {{ $motor->cc }} CC, motor ini
                    memiliki performa yang stabil, irit bahan bakar, dan cocok digunakan
                    untuk perjalanan jarak dekat maupun jauh.
                </p>

            </div>

        </div>

    </div>


    {{-- ================= REVIEW ================= --}}
    <div class="mt-16">

        <h2 class="text-2xl font-bold mb-6">
            Ulasan Pengguna
        </h2>

        <div class="space-y-6">

            @forelse($motor->reviews as $review)

                <div class="bg-white p-6 rounded-2xl shadow">

                    <div class="flex justify-between mb-2">

                        <span class="font-bold">
                            {{ $review->user->name }}
                        </span>

                        <span class="text-yellow-500">
                            ⭐ {{ $review->rating }}/5
                        </span>

                    </div>

                    <p class="text-slate-600">
                        {{ $review->comment }}
                    </p>

                </div>

            @empty

                <p class="text-slate-400">
                    Belum ada ulasan untuk motor ini.
                </p>

            @endforelse

        </div>

    </div>

</div>

</body>
</html>