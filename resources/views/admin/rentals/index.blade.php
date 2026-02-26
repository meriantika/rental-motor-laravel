@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-8">
    <h1 class="text-4xl font-black text-slate-900 uppercase">Riwayat Sewa</h1>
    <p class="text-slate-500 mb-8 italic">Daftar pesanan unit armada Anda.</p>

    <div class="grid gap-6">
        @forelse($rentals as $rental)
            <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm flex justify-between items-center">
                <div class="flex items-center gap-8">
                    {{-- Pastikan nama motor muncul --}}
                    <img src="{{ asset('storage/' . $rental->motor->foto) }}" class="w-24 h-24 object-contain">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 uppercase">{{ $rental->motor->nama_motor }}</h3>
                        <p class="text-slate-400 font-bold uppercase text-xs">{{ $rental->total_days }} Hari</p>
                    </div>
                </div>
                
                <div class="text-right">
                    <p class="text-2xl font-black text-blue-600">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase border 
                        {{ $rental->status == 'pending' ? 'bg-amber-50 text-amber-500 border-amber-100' : 'bg-emerald-50 text-emerald-500' }}">
                        {{ $rental->status }}
                    </span>
                </div>
            </div>
        @empty
            <p class="text-center text-slate-400">Belum ada riwayat sewa.</p>
        @endforelse
    </div>
</div>
@endsection