<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lengkapi Data Penyewa</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="max-w-xl mx-auto mt-20 bg-white p-8 rounded-2xl shadow">

    <h2 class="text-2xl font-bold mb-6">
        Lengkapi Data Penyewa
    </h2>

    <form method="POST" action="{{ route('profile.save') }}">

        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">
                Nama Lengkap
            </label>

            <input
                type="text"
                name="name"
                value="{{ Auth::user()->name }}"
                class="w-full border rounded-lg px-3 py-2"
            >
        </div>

        <!-- No HP -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">
                No HP
            </label>

            <input
                type="text"
                name="phone"
                value="{{ Auth::user()->phone }}"
                class="w-full border rounded-lg px-3 py-2"
            >
        </div>

        <!-- NIK -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">
                NIK
            </label>

            <input
                type="text"
                name="nik"
                value="{{ Auth::user()->nik }}"
                class="w-full border rounded-lg px-3 py-2"
            >
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">
                Alamat
            </label>

            <textarea
                name="address"
                class="w-full border rounded-lg px-3 py-2"
            >{{ Auth::user()->address }}</textarea>
        </div>

        <!-- Button -->
        <button
            type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition"
        >
            Simpan Data
        </button>

    </form>

</div>

</body>
</html>