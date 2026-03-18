<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Motor - MotoRent ID</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            transition: 0.3s ease;
        }

        /* BADGE CC */
        .spec-badge {
            background: #eef2ff;
            color: #4338ca;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        /* BADGE PRICE */
        .price-badge {
            background: #eff6ff;
            color: #2563eb;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

<!-- ================= NAVBAR ================= -->
<nav class="bg-white border-b border-slate-100 px-8 py-5 flex justify-between items-center shadow-sm sticky top-0 z-50">

    <div class="flex items-center gap-3">
        <div class="bg-blue-600 text-white p-2 rounded-xl shadow-md">⚡</div>

        <span class="text-xl font-bold text-blue-600 tracking-tight">
            MotoRent ID
        </span>
    </div>

    <div class="flex items-center gap-8">

        @if(Auth::user()->role == 'admin')

            <a href="{{ route('admin.rentals.index') }}"
               class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                Kelola Transaksi
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                Data User
            </a>

        @else

            <a href="{{ route('rentals.index') }}"
               class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                Riwayat Sewa
            </a>

            <a href="{{ route('profile.edit') }}"
               class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                Profil Saya
            </a>

        @endif

        <div class="hidden md:block text-right border-l pl-6 border-slate-200">
            <p class="text-sm font-bold">{{ Auth::user()->name }}</p>
            <p class="text-xs text-slate-400 uppercase">{{ Auth::user()->role }}</p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-50 text-red-600 px-5 py-2 rounded-2xl text-xs font-bold hover:bg-red-100 transition">
                Logout
            </button>
        </form>

    </div>

</nav>


<div class="max-w-7xl mx-auto p-8">


<!-- ================= HEADER ================= -->
<div class="mb-12 flex justify-between items-center">

    <div>
        <h1 class="text-4xl font-black uppercase tracking-tight">
            Katalog Motor
        </h1>

        <p class="text-slate-500 mt-2">
            Pilih armada terbaik untuk perjalanan Anda.
        </p>
    </div>

    @if(Auth::user()->role == 'admin')

        <a href="{{ route('motors.create') }}"
           class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg hover:scale-105 transition">
            + Tambah Motor
        </a>

    @endif

</div>


<!-- ================= FILTER ================= -->
<div class="bg-white p-8 rounded-3xl shadow-md border border-slate-100 mb-14">

<form method="GET" action="{{ route('dashboard') }}"
      class="flex flex-col md:flex-row items-center gap-4">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari motor (contoh: NMAX, PCX)..."
        class="flex-1 bg-slate-100 rounded-2xl px-6 py-4 text-sm">

    <select name="brand"
            class="bg-slate-100 rounded-2xl px-6 py-4 text-sm">

        <option value="">Semua Brand</option>

        @foreach($brands as $brand)
            <option value="{{ $brand->id }}"
                {{ request('brand') == $brand->id ? 'selected' : '' }}>
                {{ $brand->name }}
            </option>
        @endforeach

    </select>

    <input
        type="number"
        name="min_price"
        value="{{ request('min_price') }}"
        placeholder="Harga min"
        class="bg-slate-100 rounded-2xl px-4 py-4 text-sm">

    <input
        type="number"
        name="max_price"
        value="{{ request('max_price') }}"
        placeholder="Harga max"
        class="bg-slate-100 rounded-2xl px-4 py-4 text-sm">

    <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold">
        Filter
    </button>

    <a href="{{ route('dashboard') }}"
       class="bg-slate-200 px-6 py-4 rounded-2xl font-semibold">
        Reset
    </a>

</form>

</div>


<!-- ================= GRID MOTOR ================= -->
<div class="grid md:grid-cols-3 gap-8">

@forelse($motors as $motor)

<div class="bg-white rounded-3xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group relative border border-slate-100">

@if(Auth::user()->role == 'admin')

<div class="absolute top-3 right-3 flex gap-2 z-10">

<a href="{{ route('motors.edit',$motor->id) }}"
class="bg-white p-2 rounded-lg shadow hover:bg-yellow-100 transition">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-5 h-5 text-yellow-600"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>

</svg>

</a>

<form action="{{ route('motors.destroy',$motor->id) }}" method="POST">
@csrf
@method('DELETE')

<button type="button"
class="bg-white p-2 rounded-lg shadow hover:bg-red-100 transition btn-delete">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-5 h-5 text-red-600"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 3h6a1 1 0 011 1v2H8V4a1 1 0 011-1z"/>

</svg>

</button>

</form>

</div>

@endif


<a href="{{ route('motor.detail',$motor->id) }}">
<div class="h-56 bg-slate-100 overflow-hidden">

<img src="{{ $motor->image_url }}"
class="w-full h-full object-contain group-hover:scale-105 transition duration-300">

</div>
</a>


<div class="p-6">

<h3 class="font-bold text-lg text-slate-800">
{{ $motor->name }}
</h3>

<div class="flex items-center gap-2 mt-1 text-sm text-slate-500">
<span>Brand {{ $motor->brand->name ?? '-' }}</span>

<span class="spec-badge">
{{ $motor->cc }} CC
</span>
</div>

<div class="flex items-center gap-1 mt-2 text-yellow-500 text-sm">
⭐ ⭐ ⭐ ⭐ ⭐
</div>

<div class="mt-4 flex items-center justify-between">
<span class="price-badge">
Rp {{ number_format($motor->price_per_day,0,',','.') }}/hari
</span>
</div>

<div class="mt-5">

<form action="{{ route('sewa.store',$motor->id) }}" method="POST">
@csrf

<div class="grid grid-cols-2 gap-3 mb-3">

<input type="date"
name="start_date"
class="border rounded-lg px-3 py-2 text-sm w-full"
required>

<input type="date"
name="end_date"
class="border rounded-lg px-3 py-2 text-sm w-full"
required>

</div>

<div class="flex gap-3">

<a href="{{ route('motor.detail',$motor->id) }}"
class="flex-1 text-center bg-slate-900 text-white py-2 rounded-xl text-sm font-semibold hover:bg-blue-600 transition">
Detail
</a>

<button
class="flex-1 bg-blue-600 text-white py-2 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
Sewa
</button>

</div>

</form>

</div>

</div>

</div>

@empty

<div class="col-span-3 text-center text-slate-400 py-20">
Belum ada motor tersedia
</div>

@endforelse

</div>


<!-- ================= PAGINATION ================= -->
<div class="mt-12 flex justify-center">
{{ $motors->links('pagination.dashboard') }}
</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.btn-delete').forEach(button => {

button.addEventListener('click', function () {

let form = this.closest("form");

Swal.fire({
title:'Hapus motor?',
text:"Data motor akan dihapus permanen.",
icon:'warning',
showCancelButton:true,
confirmButtonColor:'#ef4444',
cancelButtonColor:'#64748b',
confirmButtonText:'Ya, hapus!',
cancelButtonText:'Batal'
}).then((result)=>{

if(result.isConfirmed){
form.submit();
}

});

});

});
</script>


<script>

@if(session('success'))

Swal.fire({
icon:'success',
title:'Berhasil!',
text:"{{ session('success') }}",
confirmButtonColor:'#2563eb'
})

@endif

</script>

</body>
</html>