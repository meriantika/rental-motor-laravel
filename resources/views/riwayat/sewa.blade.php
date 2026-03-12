@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="mb-5">
        <h2 class="fw-bold display-6">Riwayat Sewa</h2>
        <p class="text-muted">Lihat detail transaksi penyewaan motor Anda.</p>
    </div>


    {{-- ==================== SEDANG BERJALAN ==================== --}}
    <h5 class="section-title text-warning">Sedang Berjalan</h5>

    @forelse($rentalsAktif as $item)

        <div class="card-modern">

            <div>
                {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                -
                {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
            </div>

            <p class="text-xs text-slate-400">
                Transaksi:
                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
            </p>

            @include('riwayat._card', ['item' => $item])

        </div>

    @empty
        <p class="text-muted mb-4">Tidak ada sewa aktif.</p>
    @endforelse



    {{-- ==================== SELESAI ==================== --}}
    <h5 class="section-title text-success mt-5">Riwayat Selesai</h5>

    @forelse($rentalsSelesai as $item)

        <div class="card-modern">

            <div>
                {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                -
                {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
            </div>

            <p class="text-xs text-slate-400">
                Transaksi:
                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
            </p>

            @include('riwayat._card', ['item' => $item])

        </div>

    @empty
        <p class="text-muted mb-4">Belum ada transaksi selesai.</p>
    @endforelse



    {{-- ==================== DIBATALKAN ==================== --}}
    <h5 class="section-title text-danger mt-5">Dibatalkan</h5>

    @forelse($rentalsBatal as $item)

        <div class="card-modern">

            <div>
                {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                -
                {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
            </div>

            <p class="text-xs text-slate-400">
                Transaksi:
                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
            </p>

            @include('riwayat._card', ['item' => $item])

        </div>

    @empty
        <p class="text-muted">Tidak ada transaksi dibatalkan.</p>
    @endforelse

</div>



<style>

.section-title {
    font-weight:600;
    margin-bottom:20px;
}


/* ================= CARD STYLE ================= */

.card-modern {
    background:#ffffff;
    border-radius:24px;
    box-shadow:0 8px 30px rgba(0,0,0,0.04);
    transition:0.3s ease;
    margin-bottom:20px;
    padding:24px;
}

.card-modern:hover {
    transform:translateY(-4px);
    box-shadow:0 12px 40px rgba(0,0,0,0.08);
}


/* ================= TAMBAHAN STYLE BARU ================= */

.card-modern {
    background:#fff;
    border-radius:20px;
    box-shadow:0 8px 30px rgba(0,0,0,0.05);
    padding:24px;
    transition:0.3s;
}

.card-modern:hover{
    transform:translateY(-3px);
}


/* ================= MOTOR IMAGE ================= */

.image-wrapper{
    width:110px;
    height:100px;
    background:#f1f5f9;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.image-wrapper img{
    max-height:80px;
}

.placeholder-icon {
    font-size:28px;
    color:#94a3b8;
}


/* ================= BADGE ================= */

.badge-soft {
    display:inline-block;
    background:#eef2ff;
    color:#4338ca;
    padding:6px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}


/* ================= BUTTON ================= */

.btn-modern {
    display:inline-block;
    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:white;
    padding:10px 18px;
    border-radius:999px;
    font-weight:600;
    text-decoration:none;
    transition:0.3s;
}

.btn-modern:hover {
    opacity:0.85;
}


/* ================= STATUS ================= */

.status-success{
    background:#dcfce7;
    color:#166534;
    padding:6px 14px;
    border-radius:999px;
    font-size:12px;
}

.status-warning{
    background:#fef9c3;
    color:#854d0e;
    padding:6px 14px;
    border-radius:999px;
}

.status-danger{
    background:#fee2e2;
    color:#991b1b;
    padding:6px 14px;
    border-radius:999px;
}

</style>

@endsection