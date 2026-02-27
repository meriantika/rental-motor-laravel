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
        @include('riwayat._card', ['item' => $item])
    @empty
        <p class="text-muted mb-4">Tidak ada sewa aktif.</p>
    @endforelse



    {{-- ==================== SELESAI ==================== --}}
    <h5 class="section-title text-success mt-5">Riwayat Selesai</h5>

    @forelse($rentalsSelesai as $item)
        @include('riwayat._card', ['item' => $item])
    @empty
        <p class="text-muted mb-4">Belum ada transaksi selesai.</p>
    @endforelse



    {{-- ==================== DIBATALKAN ==================== --}}
    <h5 class="section-title text-danger mt-5">Dibatalkan</h5>

    @forelse($rentalsBatal as $item)
        @include('riwayat._card', ['item' => $item])
    @empty
        <p class="text-muted">Tidak ada transaksi dibatalkan.</p>
    @endforelse

</div>



<style>
.section-title {
    font-weight:600;
    margin-bottom:20px;
}

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

.image-wrapper {
    background:#f8fafc;
    border-radius:20px;
    height:110px;
    display:flex;
    align-items:center;
    justify-content:center;
}
.image-wrapper img {
    max-height:90px;
    object-fit:contain;
}
.placeholder-icon {
    font-size:28px;
    color:#94a3b8;
}

.badge-soft {
    display:inline-block;
    background:#eef2ff;
    color:#4338ca;
    padding:6px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

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
.btn-modern:hover { opacity:0.85; }

.status-success {
    background:#dcfce7;
    color:#166534;
    padding:8px 14px;
    border-radius:999px;
    font-weight:600;
}

.status-warning {
    background:#fef9c3;
    color:#854d0e;
    padding:8px 14px;
    border-radius:999px;
    font-weight:600;
}

.status-danger {
    background:#fee2e2;
    color:#991b1b;
    padding:8px 14px;
    border-radius:999px;
    font-weight:600;
}
</style>

@endsection