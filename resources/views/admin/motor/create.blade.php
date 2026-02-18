<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Motor Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('motor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nama Motor</label>
                            <input type="text" name="nama_motor" class="w-full border-gray-300 rounded-md shadow-sm mt-1" placeholder="Contoh: NMAX 155" required>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Brand</label>
                            <select name="brand" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                                <option value="Honda">Honda</option>
                                <option value="Yamaha">Yamaha</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Kawasaki">Kawasaki</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Harga Per Hari (Rp)</label>
                            <input type="number" name="harga_per_hari" class="w-full border-gray-300 rounded-md shadow-sm mt-1" required>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Gambar Motor</label>
                            <input type="file" name="gambar" class="w-full mt-1" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Simpan Motor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>