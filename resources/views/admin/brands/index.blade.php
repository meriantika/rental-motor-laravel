<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kelola Brand - MotoRent</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-50">

<div class="max-w-4xl mx-auto p-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-black">
            Kelola Brand Motor
        </h1>

        <a href="{{ route('dashboard') }}"
           class="text-blue-600 font-semibold hover:underline">

            ← Kembali ke Dashboard

        </a>

    </div>


    <!-- ALERT SUKSES -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif


    <!-- CARD TAMBAH BRAND -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">

        <h2 class="font-bold mb-4 text-lg">
            Tambah Brand Baru
        </h2>

        <form action="{{ route('brands.store') }}" method="POST" class="flex gap-3">

            @csrf

            <input
                type="text"
                name="name"
                placeholder="Contoh: Honda"
                class="flex-1 border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                required
            >

            <button
                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">

                + Tambah

            </button>

        </form>

    </div>


    <!-- LIST BRAND -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="p-5 border-b font-bold">
            Daftar Brand
        </div>

        <table class="w-full text-sm">

            <thead class="bg-slate-100">
                <tr>

                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">Nama Brand</th>
                    <th class="p-4 text-right">Aksi</th>

                </tr>
            </thead>

            <tbody>

                @forelse($brands as $brand)

                <tr class="border-t hover:bg-slate-50">

                    <td class="p-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-4 font-semibold">
                        {{ $brand->name }}
                    </td>

                    <td class="p-4 text-right">

                        <form action="{{ route('brands.destroy',$brand->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus brand ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-500 text-white px-4 py-1 rounded-lg text-xs hover:bg-red-600 transition">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="3" class="p-6 text-center text-slate-400">
                        Belum ada brand
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>