<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoRent ID - Kelola Sewa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc; 
        }
        .navbar { 
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
        }
        /* Custom styling tambahan untuk transisi modal */
        .modal-content {
            border-radius: 2.5rem;
            border: none;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <nav class="bg-white border-b px-8 py-4 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 no-underline">
            <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span class="text-xl font-bold text-blue-600 tracking-tighter">MotoRent ID</span>
        </a>
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-blue-600 uppercase tracking-widest transition-colors no-underline">
                Kembali ke dashboard
            </a>
        </div>
    </nav>

    <main class="py-4">
        @yield('content') {{-- Konten dari riwayat-sewa atau dashboard akan muncul di sini --}}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>