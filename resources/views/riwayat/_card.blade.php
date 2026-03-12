<div class="card-modern d-flex justify-content-between align-items-center">

    {{-- ================= LEFT CONTENT ================= --}}
    <div class="d-flex align-items-center gap-4">

        {{-- GAMBAR MOTOR --}}
        <div class="image-wrapper">
            @if($item->motor->image_url)
                <img src="{{ $item->motor->image_url }}">
            @else
                <div class="placeholder-icon">🏍️</div>
            @endif
        </div>

        {{-- DETAIL MOTOR --}}
        <div>
            <h5 class="fw-bold mb-1">
                {{ $item->motor->name }}
            </h5>

            <span class="badge-soft">
                {{ $item->motor->cc }} CC
            </span>

            <div class="mt-2 text-muted">
                {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                —
                {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                • {{ $item->total_days }} Hari
            </div>
        </div>

    </div>


    {{-- ================= RIGHT CONTENT ================= --}}
    <div class="text-end">

        <div class="mb-2 text-muted">
            Total Bayar
        </div>

        <div class="fw-bold fs-5 text-success mb-3">
            Rp {{ number_format($item->total_price,0,',','.') }}
        </div>


        {{-- ================= BUTTON AREA ================= --}}
        <div class="d-flex gap-2 justify-content-end">

            {{-- STATUS PENDING --}}
            @if($item->status == 'pending')

                <form action="{{ route('sewa.confirm', $item->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success rounded-pill px-4">
                        Konfirmasi
                    </button>
                </form>

                <form action="{{ route('sewa.cancel', $item->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger rounded-pill px-4">
                        Batalkan
                    </button>
                </form>


            {{-- STATUS MENUNGGU VERIFIKASI ADMIN --}}
            @elseif($item->status == 'waiting_verification')

                <span class="status-warning">
                    Menunggu Verifikasi Admin
                </span>


            {{-- STATUS BERHASIL --}}
            @elseif($item->status == 'confirmed')

                <span class="status-success">
                    Berhasil
                </span>


            {{-- STATUS DIBATALKAN --}}
            @elseif($item->status == 'cancelled')

                <span class="status-danger">
                    Dibatalkan
                </span>

            @endif

        </div>


        {{-- ================= FORM REVIEW ================= --}}
        @if($item->status == 'confirmed')

            <form action="{{ route('review.store',$item->id) }}" method="POST" class="mt-3">

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