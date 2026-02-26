@extends('layouts.app')

@section('content')
<nav class="bg-white border-b px-8 py-5 flex justify-between items-center sticky top-0 z-50 shadow-sm">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 no-underline">
        <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </div>
        <span class="text-xl font-bold text-blue-600 tracking-tighter">MotoRent ID <span class="text-slate-400 font-medium ml-2 text-sm italic">Admin Panel</span></span>
    </a>
</nav>

<div class="max-w-7xl mx-auto p-8">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight uppercase leading-tight">Manajemen Transaksi</h1>
        <p class="text-slate-500 mt-2 font-medium italic">Validasi bukti pembayaran dan kelola status penyewaan pelanggan.</p>
    </div>

    @if(session('success'))
        <div class="mb-10 p-5 bg-emerald-50 text-emerald-700 rounded-[2rem] border border-emerald-100 font-bold flex items-center gap-4 animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Pelanggan</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Unit Motor</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Total Bayar</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Bukti</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($rentals as $rental)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="font-bold text-slate-900 uppercase tracking-tight text-sm">{{ $rental->user->name }}</div>
                            <div class="text-[10px] text-slate-400">{{ $rental->user->email }}</div>
                        </td>
                        <td class="px-8 py-6 uppercase font-black text-xs text-slate-600">{{ $rental->motor->nama_motor }}</td>
                        <td class="px-8 py-6 font-black text-blue-600 text-sm">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                        <td class="px-8 py-6 text-center">
                            @if($rental->payment_proof)
                                <a href="{{ asset('storage/' . $rental->payment_proof) }}" target="_blank" class="text-blue-600 font-black text-[10px] uppercase hover:underline">Lihat Foto</a>
                            @else
                                <span class="text-[9px] text-slate-300 font-bold uppercase italic">Belum Ada</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="px-3 py-1.5 rounded-full text-[9px] font-black uppercase border 
                                {{ $rental->status == 'waiting_verification' ? 'bg-amber-50 text-amber-500 border-amber-100' : 'bg-slate-50 text-slate-400' }}">
                                {{ $rental->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex justify-center gap-2">
                                @if($rental->status == 'waiting_verification')
                                <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button class="bg-emerald-500 text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase hover:bg-emerald-600 transition-all">Konfirmasi</button>
                                </form>
                                @endif
                                <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button class="bg-white border border-rose-100 text-rose-500 px-4 py-2 rounded-xl text-[9px] font-black uppercase hover:bg-rose-50 transition-all">Tolak</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection