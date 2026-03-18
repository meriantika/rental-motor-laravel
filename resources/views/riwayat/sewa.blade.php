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

@include('riwayat._card', ['motor' => $item])

@empty
<p class="text-muted mb-4">Tidak ada sewa aktif.</p>
@endforelse



{{-- ==================== SELESAI ==================== --}}
<h5 class="section-title text-success mt-5">Riwayat Selesai</h5>

@forelse($rentalsSelesai as $item)

@include('riwayat._card', ['motor' => $item])

@empty
<p class="text-muted mb-4">Belum ada transaksi selesai.</p>
@endforelse



{{-- ==================== DIBATALKAN ==================== --}}
<h5 class="section-title text-danger mt-5">Dibatalkan</h5>

@forelse($rentalsBatal as $item)

@include('riwayat._card', ['motor' => $item])

@empty
<p class="text-muted">Tidak ada transaksi dibatalkan.</p>
@endforelse

</div>
@endsection