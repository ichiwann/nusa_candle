<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NusaCandle - Lilin Aroma Terapi Khas Malang')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FAF9F6] text-[#2C1810] flex flex-col min-h-screen">

    {{-- Navbar Component --}}
    <x-pembeli.navbar />

    {{-- Konten Utama --}}
    <main class="flex-grow w-full relative">
        
        {{-- ✅ NOTIFIKASI GLOBAL SUCCESS --}}
        @if (session('success'))
            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div role="status" class="flex items-center gap-3 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 rounded-lg shadow-sm animate-fade-in-down">
                    <svg class="w-5 h-5 flex-shrink-0 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- ✅ NOTIFIKASI GLOBAL ERROR --}}
        @if ($errors->any())
            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div role="alert" class="flex items-start gap-3 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 rounded-lg shadow-sm animate-fade-in-down">
                    <svg class="w-5 h-5 flex-shrink-0 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="font-semibold mb-1">Mohon periksa kembali:</p>
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Konten Halaman --}}
        @yield('content')
        
    </main>

    {{-- Footer Component --}}
    <x-pembeli.footer />

</body>
</html>