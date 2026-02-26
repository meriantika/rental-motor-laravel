@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Header Section --}}
    <div class="header-section mb-5">
        <h2 class="fw-bold text-dark text-uppercase tracking-tighter">Manajemen Transaksi</h2>
        <p class="text-muted italic small">Validasi bukti pembayaran dan kelola status penyewaan pelanggan.</p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-uppercase small tracking-wider">
                        <th class="px-4 py-3">Pelanggan</th>
                        <th class="py-3">Unit Motor</th>
                        <th class="py-3">Total Bayar</th>
                        <th class="py-3 text-center">Bukti Transfer</th>
                        <th class="py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentals as $item)
                    <tr>
                        <td class="px-4">
                            <div class="fw-bold text-dark">{{ $item->user->name ?? 'User' }}</div>
                            <div class="small text-muted">{{ $item->user->email ?? '-' }}</div>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $item->motor->nama_motor ?? 'Motor' }}</div>
                            <div class="small text-muted">{{ $item->total_days }} Hari</div>
                        </td>
                        <td>
                            <span class="fw-bold text-primary">Rp {{ number_format($item->total_price, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-center">
                            @if($item->bukti_pembayaran)
                                <button type="button" class="btn btn-sm btn-info text-white rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#viewBukti{{ $item->id }}">
                                    LIHAT BUKTI
                                </button>
                            @else
                                <span class="text-muted small italic">Belum Upload</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $badgeClass = [
                                    'pending' => 'bg-secondary',
                                    'waiting_verification' => 'bg-warning text-dark',
                                    'confirmed' => 'bg-success',
                                    'cancelled' => 'bg-danger'
                                ][$item->status] ?? 'bg-light';
                            @endphp
                            <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 small fw-bold">
                                {{ strtoupper(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>
                        <td class="px-4 text-center">
                            @if($item->status == 'waiting_verification')
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Form Konfirmasi --}}
                                    <form action="{{ route('admin.rentals.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold" onclick="return confirm('Konfirmasi pembayaran ini?')">SETUJU</button>
                                    </form>
                                    
                                    {{-- Form Tolak --}}
                                    <form action="{{ route('admin.rentals.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold" onclick="return confirm('Tolak transaksi ini?')">TOLAK</button>
                                    </form>
                                </div>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                    </tr>

                    {{-- Modal Popup untuk Melihat Bukti Transfer --}}
                    @if($item->bukti_pembayaran)
                    <div class="modal fade" id="viewBukti{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">
                                <div class="modal-header bg-dark text-white rounded-top-4">
                                    <h5 class="modal-title fw-bold">BUKTI TRANSFER: {{ strtoupper($item->user->name) }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center p-4">
                                    <img src="{{ asset('storage/' . $item->bukti_pembayaran) }}" 
                                         class="img-fluid rounded-3 shadow-sm" 
                                         alt="Bukti Transfer"
                                         style="max-height: 500px;">
                                    <div class="mt-3 p-3 bg-light rounded-3 text-start">
                                        <p class="mb-1 small"><b>Total Tagihan:</b> Rp {{ number_format($item->total_price, 0, ',', '.') }}</p>
                                        <p class="mb-0 small"><b>Tanggal Sewa:</b> {{ $item->start_date }} - {{ $item->end_date }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection