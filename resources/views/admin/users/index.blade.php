<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<title>Data User - MotoRent</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
body{
font-family:'Plus Jakarta Sans',sans-serif;
}
</style>

</head>

<body class="bg-slate-100">

<div class="max-w-6xl mx-auto py-10 px-6">

<!-- HEADER -->
<div class="flex justify-between items-center mb-8">

<div>
<h1 class="text-3xl font-black text-slate-800">
Data User
</h1>

<p class="text-slate-500">
Daftar pengguna yang terdaftar di sistem MotoRent.
</p>
</div>

<a href="{{ route('dashboard') }}"
class="bg-slate-900 text-white px-6 py-2 rounded-xl font-semibold hover:bg-blue-600 transition">

Kembali

</a>

</div>


<!-- CARD -->
<div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-slate-200">

<table class="w-full text-sm">

<thead class="bg-slate-900 text-white">

<tr>

<th class="px-6 py-4 text-left">Nama</th>

<th class="px-6 py-4 text-left">Email</th>

<th class="px-6 py-4 text-left">No HP</th>

<th class="px-6 py-4 text-left">NIK</th>

<th class="px-6 py-4 text-left">Alamat</th>

</tr>

</thead>

<tbody class="divide-y">

@forelse($users as $user)

<tr class="hover:bg-slate-50 transition">

<td class="px-6 py-4 font-semibold text-slate-700">
{{ $user->name }}
</td>

<td class="px-6 py-4 text-slate-600">
{{ $user->email }}
</td>

<td class="px-6 py-4 text-slate-600">
{{ $user->phone ?? '-' }}
</td>

<td class="px-6 py-4 text-slate-600">
{{ $user->nik ?? '-' }}
</td>

<td class="px-6 py-4 text-slate-600">
{{ $user->address ?? '-' }}
</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center py-10 text-slate-400 font-semibold">

Belum ada data user

</td>

</tr>

@endforelse

</tbody>

</table>

</div>


<!-- PAGINATION -->
<div class="mt-6 flex justify-center">
    {{ $users->links() }}
</div>

</div>

</body>
</html>