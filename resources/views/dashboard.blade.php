<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Motor - MotoRent ID</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .dashboard-pagination {
            display:flex;
            justify-content:center;
            align-items:center;
            gap:10px;
            margin-top:50px;
        }

        .page-btn {
            display:flex;
            align-items:center;
            justify-content:center;
            width:42px;
            height:42px;
            border-radius:14px;
            background:#f1f5f9;
            color:#1e293b;
            font-weight:600;
            text-decoration:none;
            transition:all 0.3s ease;
        }

        .page-btn:hover {
            background:#e2e8f0;
            transform:translateY(-2px);
        }

        .page-btn.active {
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            color:white;
            box-shadow:0 8px 20px rgba(37,99,235,0.25);
        }

        .page-btn.disabled {
            opacity:0.4;
            pointer-events:none;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            transition: 0.3s ease;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

{{-- ================= NAVBAR ================= --}}
<nav class="bg-white border-b border-slate-100 px-8 py-5 flex justify-between items-center shadow-sm sticky top-0 z-50">

    <div class="flex items-center gap-3">
        <div class="bg-blue-600 text-white p-2 rounded-xl shadow-md">
            ⚡
        </div>
        <span class="text-xl font-bold text-blue-600 tracking-tight">
            MotoRent ID
        </span>
    </div>

    <div class="flex items-center gap-8">

        {{-- ROLE BASED MENU --}}
        @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.rentals.index') }}"
               class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                Kelola Transaksi
            </a>
        @else
            <a href="{{ route('rentals.index') }}"
               class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                Riwayat Sewa
            </a>
        @endif

        <div class="hidden md:block text-right border-l pl-6 border-slate-200">
            <p class="text-sm font-bold">{{ Auth::user()->name }}</p>

            <div class="flex items-center justify-end gap-2">
                <p class="text-xs text-slate-400 uppercase">
                    {{ Auth::user()->role }}
                </p>

                @if(Auth::user()->role == 'admin')
                    <span class="bg-purple-600 text-white text-[10px] px-3 py-1 rounded-full font-bold">
                        ADMIN MODE
                    </span>
                @endif
            </div>
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

    {{-- HEADER --}}
    <div class="mb-12 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black uppercase tracking-tight">Katalog Motor</h1>
            <p class="text-slate-500 mt-2">Pilih armada terbaik untuk perjalanan Anda.</p>
        </div>

        @if(Auth::user()->role == 'admin')
        <a href="{{ route('motors.create') }}"
           class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg hover:scale-105 transition">
            + Tambah Motor
        </a>
        @endif
    </div>

    {{-- FILTER --}}
    <div class="bg-white p-8 rounded-3xl shadow-md border border-slate-100 mb-14">

        <form action="{{ route('dashboard') }}" method="GET"
              class="flex flex-col md:flex-row items-center gap-4">

            <div class="relative flex-1 w-full">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari motor (contoh: NMAX, PCX)..."
                       class="w-full bg-slate-100 rounded-2xl pl-12 pr-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    🔍
                </span>
            </div>

            <div class="w-full md:w-56">
                <select name="brand"
                        class="w-full bg-slate-100 rounded-2xl px-6 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">Semua Brand</option>
                    <option value="Honda" {{ request('brand')=='Honda'?'selected':'' }}>Honda</option>
                    <option value="Yamaha" {{ request('brand')=='Yamaha'?'selected':'' }}>Yamaha</option>
                </select>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <button type="submit"
                    class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-600 transition shadow-md">
                    Filter
                </button>

                <a href="{{ route('dashboard') }}"
                   class="bg-slate-200 px-6 py-4 rounded-2xl font-semibold hover:bg-slate-300 transition">
                    Reset
                </a>
            </div>

        </form>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

        @forelse($motors as $motor)
        <div class="bg-white rounded-3xl border overflow-hidden shadow-sm card-hover relative">

            @if(Auth::user()->role == 'admin')
            <div class="absolute top-4 right-4 flex gap-2 z-20">
                <a href="{{ route('motors.edit', $motor->id) }}"
                   class="bg-white p-2 rounded-xl shadow-md hover:bg-yellow-400 hover:text-white transition">
                    ✏
                </a>

                <form id="delete-form-{{ $motor->id }}"
                      action="{{ route('motors.destroy', $motor->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="confirmDelete({{ $motor->id }})"
                            class="bg-white p-2 rounded-xl shadow-md hover:bg-red-500 hover:text-white transition">
                        🗑
                    </button>
                </form>
            </div>
            @endif

            <div class="h-60 bg-slate-100 flex items-center justify-center">
                @if($motor->image_url)
                    <img src="{{ $motor->image_url }}" class="h-full object-contain p-6">
                @else
                    <span class="text-slate-300 text-5xl font-bold">
                        {{ $motor->brand }}
                    </span>
                @endif
            </div>

            <div class="p-8">
                <h3 class="text-xl font-bold mb-1">{{ $motor->name }}</h3>
                <p class="text-sm text-slate-500 mb-3">{{ $motor->cc }} CC</p>

                <p class="text-2xl font-black mb-5">
                    Rp {{ number_format($motor->price_per_day,0,',','.') }}
                </p>

                @if(Auth::user()->role == 'user')
                <form action="{{ route('sewa.store',$motor->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="date" name="start_date" required min="{{ date('Y-m-d') }}"
                           class="w-full bg-slate-100 rounded-xl px-3 py-2 text-sm">
                    <input type="date" name="end_date" required min="{{ date('Y-m-d') }}"
                           class="w-full bg-slate-100 rounded-xl px-3 py-2 text-sm">
                    <button class="w-full bg-slate-900 text-white py-3 rounded-2xl font-bold hover:bg-blue-600 transition">
                        Sewa Sekarang
                    </button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <p class="text-slate-400 font-bold">Tidak ada motor ditemukan.</p>
        </div>
        @endforelse

    </div>

    <div class="dashboard-pagination">
        {{ $motors->withQueryString()->links('pagination.dashboard') }}
    </div>

</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Motor?',
        text: "Data yang dihapus tidak bisa dikembalikan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

</body>
</html>