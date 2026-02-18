<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ED.Rent - Rental Motor Cepat & Aman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">

    <section class="flex flex-col md:flex-row min-h-screen items-stretch">
        <div class="w-full md:w-1/2 p-10 lg:p-24 flex flex-col justify-center">
            <h1 class="text-6xl font-extrabold text-blue-600 mb-2">ED.Rent</h1>
            <h2 class="text-3xl font-bold mb-8">Website + Dashboard</h2>
            
            <div class="max-w-md">
                <p class="text-gray-500 text-lg leading-relaxed mb-6">
                    Ini adalah template desain UI/UX di Figma yang digunakan untuk tugas Bootcamp Programming Eduwork dan mencakup elemen-elemen penting.
                </p>
                <p class="text-gray-500 text-lg leading-relaxed mb-12">
                    Anda bisa menyalin, menempel, mengisi bagian dan menambahkan halaman sesuai dengan proyek Anda.
                </p>
            </div>

            <div class="flex items-center gap-6 mt-auto">
                <img src="https://eduwork.id/assets/favicon.ico" alt="Logo" class="h-10">
                <span class="font-bold text-xl">eduwork</span>
                <span class="text-gray-400 border-l pl-6 border-gray-300">eduwork.id</span>
            </div>
        </div>

        <div class="w-full md:w-1/2 relative bg-gray-200">
            <img src="https://images.unsplash.com/photo-1558981403-c5f91cbba527?auto=format&fit=crop&q=80&w=1000" 
                 alt="Rental Motor" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 flex items-center p-12">
                <h3 class="text-white text-5xl font-bold leading-tight">
                    Rental Motor <br> Cepat & Aman, <br> Mulai Rp75.000/ <br> hari
                </h3>
            </div>
        </div>
    </section>

    <section class="py-20 px-10 lg:px-24 bg-gray-50">
        <h3 class="text-3xl font-bold mb-10">Pilihan Motor</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                <div class="h-56 bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=500" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h4 class="text-2xl font-bold">Scoopy</h4>
                    <p class="text-gray-400 mb-4">Honda</p>
                    <p class="text-orange-500 text-2xl font-bold mb-6">Rp 250,000 <span class="text-sm text-gray-400">/hari</span></p>
                    <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition">
                        Sewa Sekarang
                    </button>
                </div>
            </div>

            </div>
    </section>

</body>
</html>