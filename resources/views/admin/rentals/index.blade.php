<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Transaksi - MotoRent</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50">

<div class="max-w-7xl mx-auto p-10">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-black">Kelola Transaksi</h1>

        <a href="{{ route('dashboard') }}"
           class="text-blue-600 font-semibold hover:underline">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- ================= STATISTIK ================= --}}
    <div class="grid md:grid-cols-5 gap-6 mb-10">

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-400 text-sm">Total Transaksi</p>
            <h2 class="text-2xl font-bold mt-2">{{ $totalTransaksi }}</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-400 text-sm">Menunggu Verifikasi</p>
            <h2 class="text-2xl font-bold mt-2 text-yellow-500">
                {{ $totalPending }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-400 text-sm">Total Pendapatan</p>
            <h2 class="text-2xl font-bold mt-2 text-green-600">
                Rp {{ number_format($totalPendapatan,0,',','.') }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-400 text-sm">Confirmed</p>
            <h2 class="text-2xl font-bold mt-2 text-blue-600">
                {{ $totalConfirmed }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-slate-400 text-sm">Cancelled</p>
            <h2 class="text-2xl font-bold mt-2 text-red-600">
                {{ $totalCancelled }}
            </h2>
        </div>

    </div>

    {{-- ================= FILTER ================= --}}
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <form method="GET" action="{{ route('admin.rentals.index') }}"
              class="grid md:grid-cols-4 gap-4 items-end">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Tanggal Transaksi
                </label>
                <input type="date"
                       name="transaction_date"
                       value="{{ request('transaction_date') }}"
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Status
                </label>
                <select name="status"
                        class="w-full border rounded-xl px-4 py-3">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="waiting_verification" {{ request('status') == 'waiting_verification' ? 'selected' : '' }}>
                        Waiting Verification
                    </option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                        Confirmed
                    </option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                    Filter
                </button>

                <a href="{{ route('admin.rentals.index') }}"
                   class="bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-semibold hover:bg-slate-300 transition">
                    Reset
                </a>
            </div>

        </form>
    </div>

    {{-- ================= TABLE ================= --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="p-4">User</th>
                    <th class="p-4">Motor</th>
                    <th class="p-4">Tanggal Sewa</th>
                    <th class="p-4">Tanggal Transaksi</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Bukti</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-center">Update Status</th>
                </tr>
            </thead>

            <tbody>
            @forelse($rentals as $rental)
                <tr class="border-t hover:bg-slate-50 transition">

                    <td class="p-4 font-semibold">
                        {{ $rental->user->name }}
                    </td>

                    <td class="p-4">
                        {{ $rental->motor->name }}
                    </td>

                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($rental->start_date)->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse($rental->end_date)->format('d M Y') }}
                    </td>

                    <td class="p-4 text-slate-600">
                        {{ \Carbon\Carbon::parse($rental->created_at)->format('d M Y') }}
                    </td>

                    <td class="p-4 font-bold text-green-600">
                        Rp {{ number_format($rental->total_price,0,',','.') }}
                    </td>

                    {{-- BUKTI TRANSFER --}}
                    <td class="p-4">
                    @if($rental->payment_proof)

                    <a href="{{ asset('payment_proofs/'.$rental->payment_proof) }}"
                       target="_blank"
                       class="text-blue-600 underline">
                    Lihat Bukti
                    </a>

                    @else
                    <span class="text-slate-400 text-xs">Belum ada</span>
                    @endif
                    </td>

                    {{-- STATUS BADGE --}}
                    <td class="p-4">
                        @if($rental->status == 'waiting_verification')
                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                                Waiting
                            </span>
                        @elseif($rental->status == 'confirmed')
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                Confirmed
                            </span>
                        @elseif($rental->status == 'cancelled')
                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                Cancelled
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">
                                Pending
                            </span>
                        @endif
                    </td>

                    {{-- UPDATE STATUS --}}
                    <td class="p-4 text-center">

                    <form action="{{ route('admin.rentals.update',$rental->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="flex justify-center items-center gap-2">

                    <select name="status" class="border rounded-lg px-3 py-2">

                    <option value="pending" {{ $rental->status=='pending'?'selected':'' }}>
                    Pending
                    </option>

                    <option value="waiting_verification" {{ $rental->status=='waiting_verification'?'selected':'' }}>
                    Waiting Verification
                    </option>

                    <option value="confirmed" {{ $rental->status=='confirmed'?'selected':'' }}>
                    Confirmed
                    </option>

                    <option value="cancelled" {{ $rental->status=='cancelled'?'selected':'' }}>
                    Cancelled
                    </option>

                    </select>

                    <input type="file"
                    name="payment_proof"
                    class="text-sm border rounded p-1">

                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Update
                    </button>

                    </div>

                    </form>

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-6 text-center text-slate-400">
                        Belum ada transaksi.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>

    <div class="mt-6">
        {{ $rentals->links() }}
    </div>

</div>

</body>
</html>