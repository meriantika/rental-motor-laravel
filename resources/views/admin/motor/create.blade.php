<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Unit Motor Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900">Input Data Armada</h3>
                    <p class="text-gray-500 text-sm">Pastikan semua informasi spesifikasi motor diisi dengan benar.</p>
                </div>

                {{-- Menampilkan Error Validasi --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-bold">Mohon perbaiki kesalahan berikut:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm ml-7">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Tambah Motor --}}
                <form action="{{ route('motors.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Motor --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Nama Model Motor</label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition @error('name') border-red-500 @enderror" 
                                placeholder="Contoh: Honda Vario 160" required>
                        </div>

                        {{-- URL Gambar --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Link/URL Gambar Motor</label>
                            <input type="text" name="image_url" value="{{ old('image_url') }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition @error('image_url') border-red-500 @enderror" 
                                placeholder="https://link-gambar.com/motor.jpg" required>
                            <p class="mt-1 text-xs text-gray-400 italic">Gunakan link gambar (jpg/png/webp) dari internet.</p>
                        </div>

                        {{-- Brand --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Brand</label>
                            <select name="brand" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition cursor-pointer">
                                <option value="" disabled {{ old('brand') ? '' : 'selected' }}>Pilih Brand</option>
                                <option value="Honda" {{ old('brand') == 'Honda' ? 'selected' : '' }}>Honda</option>
                                <option value="Yamaha" {{ old('brand') == 'Yamaha' ? 'selected' : '' }}>Yamaha</option>
                                <option value="Suzuki" {{ old('brand') == 'Suzuki' ? 'selected' : '' }}>Suzuki</option>
                                <option value="Kawasaki" {{ old('brand') == 'Kawasaki' ? 'selected' : '' }}>Kawasaki</option>
                            </select>
                        </div>

                        {{-- Kapasitas Mesin (CC) --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Kapasitas Mesin (CC)</label>
                            <input type="number" name="cc" value="{{ old('cc') }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" 
                                placeholder="Contoh: 155" required>
                        </div>

                        {{-- Tipe --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Tipe Motor</label>
                            <select name="type" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition cursor-pointer">
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Pilih Tipe</option>
                                <option value="Matic" {{ old('type') == 'Matic' ? 'selected' : '' }}>Matic</option>
                                <option value="Manual" {{ old('type') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                <option value="Sport" {{ old('type') == 'Sport' ? 'selected' : '' }}>Sport</option>
                            </select>
                        </div>

                        {{-- Harga Sewa --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-gray-700">Harga Sewa / Hari (Rp)</label>
                            <input type="number" name="price_per_day" value="{{ old('price_per_day') }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" 
                                placeholder="150000" required>
                        </div>
                    </div>

                    <div class="pt-6 flex items-center gap-4">
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-200 transition duration-300 transform active:scale-95 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            SIMPAN UNIT SEKARANG
                        </button>
                        <a href="{{ route('dashboard') }}" 
                            class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 px-8 rounded-xl transition duration-300 text-center">
                            BATAL
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>