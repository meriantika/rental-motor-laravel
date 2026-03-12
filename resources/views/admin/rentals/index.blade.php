<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Transaksi - MotoRent</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div class="grid md:grid-cols-3 gap-6 mb-10">

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
                    <th class="p-4 text-center">Aksi</th>
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

                    {{-- TANGGAL SEWA --}}
                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($rental->start_date)->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse($rental->end_date)->format('d M Y') }}
                    </td>

                    {{-- TANGGAL TRANSAKSI --}}
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

                    {{-- AKSI --}}
                    <td class="p-4 text-center">

                    @if($rental->status == 'waiting_verification')

                    <div class="flex justify-center gap-2 items-center">

                    {{-- APPROVE + UPLOAD BUKTI --}}
                    <form action="{{ route('admin.rentals.update',$rental->id) }}"
                          method="POST"
                          enctype="multipart/form-data"
                          class="flex items-center gap-2">

                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status" value="confirmed">

                    <input type="file"
                           name="payment_proof"
                           required
                           class="text-sm border rounded p-1">

                    <button class="bg-green-500 text-white px-3 py-1 rounded">
                    ✔ Approve
                    </button>

                    </form>

                    {{-- REJECT --}}
                    <form id="reject-{{ $rental->id }}"
                          action="{{ route('admin.rentals.update', $rental->id) }}"
                          method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="cancelled">

                    <button type="button"
                            onclick="rejectRental({{ $rental->id }})"
                            class="bg-red-500 text-white px-3 py-1 rounded">
                    ✖ Tolak
                    </button>

                    </form>

                    </div>

                    @else

                    <form action="{{ route('admin.rentals.reset',$rental->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button class="bg-gray-500 text-white px-4 py-1 rounded-lg text-xs font-bold hover:bg-gray-600 transition">
                    Reset
                    </button>

                    </form>

                    @endif

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

{{-- SWEETALERT SCRIPT --}}
<script>
function rejectRental(id) {
    Swal.fire({
        title: 'Tolak transaksi?',
        text: "Status akan diubah menjadi Cancelled",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Tolak'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('reject-' + id).submit();
        }
    });
}
</script>

</body>
</html>