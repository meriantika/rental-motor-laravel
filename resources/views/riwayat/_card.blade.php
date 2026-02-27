@php $motor = $item->motor; @endphp

<div class="card-modern">
    <div class="row align-items-center">

        <div class="col-md-2">
            <div class="image-wrapper">
                @if($motor && $motor->foto)
                    <img src="{{ asset('storage/' . $motor->foto) }}">
                @else
                    <div class="placeholder-icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-5">
            <h4 class="fw-semibold mb-1">
                {{ optional($motor)->nama_motor ?? optional($motor)->name }}
            </h4>

            <span class="badge-soft mb-2">
                {{ optional($motor)->cc ?? '-' }} CC
            </span>

            <p class="text-muted small mb-0">
                {{ date('d M Y', strtotime($item->start_date)) }}
                —
                {{ date('d M Y', strtotime($item->end_date)) }}
                •
                <span class="text-primary fw-semibold">
                    {{ $item->total_days }} Hari
                </span>
            </p>
        </div>

        <div class="col-md-3 text-md-end">
            <p class="text-muted small mb-1">Total Bayar</p>
            <h4 class="fw-bold text-success">
                Rp {{ number_format($item->total_price,0,',','.') }}
            </h4>
        </div>

        <div class="col-md-2 text-center">
            @if($item->status == 'pending')
                <a href="#" class="btn-modern">Konfirmasi</a>
            @elseif($item->status == 'waiting_verification')
                <span class="status-warning">Menunggu</span>
            @elseif($item->status == 'confirmed')
                <span class="status-success">Berhasil</span>
            @elseif($item->status == 'cancelled')
                <span class="status-danger">Dibatalkan</span>
            @endif
        </div>

    </div>
</div>