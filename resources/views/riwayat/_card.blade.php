<div class="card-modern d-flex justify-content-between align-items-center">

    {{-- ================= LEFT CONTENT ================= --}}
    <div class="d-flex align-items-center gap-4">

        {{-- GAMBAR MOTOR --}}
        <div class="image-wrapper">

            @if($motor?->motor?->image_url)
                <img src="{{ $motor->motor->image_url }}" alt="motor">
            @else
                <div class="placeholder-icon">🏍️</div>
            @endif

        </div>

        {{-- DETAIL MOTOR --}}
        <div>

            <h5 class="fw-bold mb-1">
                {{ $motor?->motor?->name ?? 'Motor tidak tersedia' }}
            </h5>

            <span class="badge-soft">
                {{ $motor?->motor?->cc ?? '-' }} CC
            </span>

            <div class="mt-2 text-muted">

                {{ $motor?->start_date 
                    ? \Carbon\Carbon::parse($motor->start_date)->format('d M Y') 
                    : '-' }}

                —

                {{ $motor?->end_date 
                    ? \Carbon\Carbon::parse($motor->end_date)->format('d M Y') 
                    : '-' }}

                • {{ $motor?->total_days ?? 0 }} Hari

            </div>


            {{-- ================= STATUS PROGRESS ================= --}}
            <div class="status-progress">

                <div class="status-label">

                @if($motor->status == 'pending')
                <span class="badge pending">Menunggu Konfirmasi</span>

                @elseif($motor->status == 'waiting_verification')
                <span class="badge verify">Menunggu Verifikasi Admin</span>

                @elseif($motor->status == 'confirmed')
                <span class="badge success">Sewa Berhasil</span>

                @elseif($motor->status == 'cancelled')
                <span class="badge cancel">Dibatalkan</span>
                @endif

                </div>

                <div class="progress-bar">

                    <div class="progress-fill
                    @if($motor->status == 'pending') p30
                    @elseif($motor->status == 'waiting_verification') p60
                    @elseif($motor->status == 'confirmed') p100
                    @endif
                    "></div>

                </div>

            </div>

        </div>

    </div>


    {{-- ================= RIGHT CONTENT ================= --}}
    <div class="text-end">

        <div class="mb-2 text-muted">
            Total Bayar
        </div>

        <div class="fw-bold fs-5 text-success mb-3">
            Rp {{ number_format($motor?->total_price ?? 0,0,',','.') }}
        </div>


        {{-- ================= BUTTON AREA ================= --}}
        <div class="d-flex gap-2 justify-content-end">

            {{-- STATUS PENDING --}}
            @if($motor?->status == 'pending')

                <form action="{{ route('sewa.confirm', $motor->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success rounded-pill px-4">
                        Konfirmasi
                    </button>
                </form>

                <form action="{{ route('sewa.cancel', $motor->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger rounded-pill px-4">
                        Batalkan
                    </button>
                </form>


            {{-- STATUS MENUNGGU VERIFIKASI ADMIN --}}
            @elseif($motor?->status == 'waiting_verification')

                <span class="status-warning">
                    Menunggu Verifikasi Admin
                </span>


            {{-- STATUS BERHASIL --}}
            @elseif($motor?->status == 'confirmed')

                <span class="status-success">
                    Berhasil
                </span>


            {{-- STATUS DIBATALKAN --}}
            @elseif($motor?->status == 'cancelled')

                <span class="status-danger">
                    Dibatalkan
                </span>

            @endif

        </div>


        {{-- ================= FORM REVIEW ================= --}}
        @if($motor?->status == 'confirmed')

            <form action="{{ route('review.store',$motor->id) }}" method="POST" class="mt-3">

                @csrf

                <select name="rating" class="border rounded p-2">
                    <option value="5">⭐⭐⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="1">⭐</option>
                </select>

                <textarea
                    name="comment"
                    class="border rounded p-2 w-full mt-2"
                    placeholder="Tulis ulasan..."
                ></textarea>

                <button class="bg-blue-600 text-white px-4 py-2 rounded mt-2">
                    Kirim Ulasan
                </button>

            </form>

        @endif

    </div>

</div>


{{-- ================= CSS ================= --}}
<style>

.image-wrapper{
width:110px;
height:80px;
background:#f8fafc;
border-radius:12px;
overflow:hidden;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
display:flex;
align-items:center;
justify-content:center;
flex-shrink:0;
}

.image-wrapper img{
width:100%;
height:100%;
object-fit:contain;
}


/* ================= STATUS PROGRESS ================= */

.status-progress{
margin-top:12px;
}

.status-label{
margin-bottom:6px;
}

.badge{
padding:4px 10px;
border-radius:999px;
font-size:12px;
font-weight:600;
}

.badge.pending{
background:#fef9c3;
color:#854d0e;
}

.badge.verify{
background:#e0f2fe;
color:#0369a1;
}

.badge.success{
background:#dcfce7;
color:#166534;
}

.badge.cancel{
background:#fee2e2;
color:#991b1b;
}

.progress-bar{
height:6px;
background:#e2e8f0;
border-radius:999px;
overflow:hidden;
}

.progress-fill{
height:100%;
background:#22c55e;
transition:0.4s;
}

.p30{width:30%;}
.p60{width:60%;}
.p100{width:100%;}

</style>