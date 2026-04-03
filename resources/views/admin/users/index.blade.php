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
<th class="px-6 py-4 text-center">Aksi</th>

</tr>

</thead>

<tbody class="divide-y">

@forelse($users as $user)

<tr class="border-b border-slate-100 hover:bg-slate-50 transition">
    <td class="px-6 py-5 font-semibold text-slate-800">{{ $user->name }}</td>
    <td class="px-6 py-5 text-slate-600">{{ $user->email }}</td>
    <td class="px-6 py-5 text-slate-600">{{ $user->phone ?? '-' }}</td>
    <td class="px-6 py-5 text-slate-600">{{ $user->nik ?? '-' }}</td>
    <td class="px-6 py-5 text-slate-600">{{ $user->address ?? '-' }}</td>

    <td class="px-6 py-5 text-center">
        <div class="flex items-center justify-center gap-2">

            <a href="{{ route('admin.users.edit', $user->id) }}"
               class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-yellow-200 transition">
                Edit
            </a>

            @if($user->role !== 'admin')
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="form-delete-user">
                @csrf
                @method('DELETE')
                <button type="button"
                        class="btn-delete-user bg-red-100 text-red-700 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-red-200 transition">
                    Hapus
                </button>
            </form>
            @endif

        </div>
    </td>
</tr>

@empty

<tr>

<td colspan="6" class="text-center py-10 text-slate-400 font-semibold">

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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.btn-delete-user').forEach(button => {
    button.addEventListener('click', function () {
        let form = this.closest("form");

        Swal.fire({
            title: 'Hapus user?',
            text: "Data user akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#2563eb'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc2626'
});
</script>
@endif

</body>
</html>