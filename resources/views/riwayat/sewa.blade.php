@extends('layouts.app') {{-- Menghubungkan ke resources/views/layouts/app.blade.php --}}

@section('content')
<div class="container py-5">
    {{-- Header Halaman --}}
    <div class="header-section mb-5">
        <h2 class="fw-bold text-dark text-uppercase tracking-tight">RIWAYAT SEWA</h2>
        <p class="text-muted">Daftar pesanan unit armada Anda. Silakan konfirmasi pembayaran melalui WhatsApp.</p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="rental-list">
        @forelse($rentals as $item)
            {{-- 1. Kartu Pesanan --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4 p-3 hover-shadow transition">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        @if($item->motor && $item->motor->foto)
                            <img src="{{ asset('storage/' . $item->motor->foto) }}" 
                                 alt="{{ $item->motor->nama_motor }}" 
                                 class="img-fluid rounded-4 shadow-sm" 
                                 style="height: 100px; width: 100%; object-fit: cover;"
                                 onerror="this.onerror=null;this.src='{{ asset('img/no-motor.png') }}';">
                        @else
                            <div class="bg-light rounded-4 d-flex align-items-center justify-content-center" style="height: 100px; width: 100%;">
                                <i class="fas fa-motorcycle fa-2x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h4 class="fw-bold mb-0 text-uppercase">{{ $item->motor->nama_motor ?? 'Unit Tidak Diketahui' }}</h4>
                            <span class="badge bg-light text-primary border-primary border-opacity-10">{{ $item->motor->cc ?? '-' }} CC</span>
                        </div>
                        <p class="text-muted mb-0 small">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ date('d M', strtotime($item->start_date)) }} — {{ date('d M Y', strtotime($item->end_date)) }} 
                            | <span class="text-primary fw-bold">{{ $item->total_days }} HARI</span>
                        </p>
                    </div>
                    <div class="col-md-3 text-md-end">
                        <p class="text-muted small mb-0">TOTAL BAYAR</p>
                        <h4 class="fw-bold mb-0 text-primary">Rp {{ number_format($item->total_price, 0, ',', '.') }}</h4>
                    </div>
                    <div class="col-md-2 text-center">
                        {{-- Logika Status & Tombol WhatsApp --}}
                        @if($item->status == 'pending')
                            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20MotoRent%20ID,%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20pesanan%20{{ $item->motor->nama_motor }}%20dengan%20ID%20Sewa:%20{{ $item->id }}" 
                               target="_blank"
                               class="btn btn-success w-100 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="fab fa-whatsapp"></i> KONFIRMASI WA
                            </a>
                        @elseif($item->status == 'waiting_verification')
                            <span class="badge bg-warning text-dark py-2 px-3 rounded-pill w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-clock"></i> MENUNGGU VALIDASI
                            </span>
                        @elseif($item->status == 'confirmed')
                            <span class="badge bg-success py-2 px-3 rounded-pill w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-check"></i> BERHASIL
                            </span>
                            <button class="btn btn-outline-primary btn-sm w-100 mt-2 rounded-pill fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalReview{{ $item->id }}">
                                BERI ULASAN
                            </button>
                        @elseif($item->status == 'cancelled')
                            <span class="badge bg-danger py-2 px-3 rounded-pill w-100">DIBATALKAN</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <div class="mb-3 text-muted opacity-50">
                    <i class="fas fa-motorcycle fa-4x"></i>
                </div>
                <p class="text-muted mb-4 font-medium">Belum ada riwayat penyewaan.</p>
                <a href="{{ route('katalog') }}" class="btn btn-primary px-5 py-2 rounded-pill fw-bold shadow-sm">Cek Katalog Sekarang</a>
            </div>
        @endforelse
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.075)!important;
    }
    .transition { transition: all 0.3s ease; }
    .text-primary { color: #0d6efd !important; }
    .btn-success { background-color: #25d366 !important; border-color: #25d366 !important; }
    .btn-success:hover { background-color: #128c7e !important; border-color: #128c7e !important; }
</style>
@endsection