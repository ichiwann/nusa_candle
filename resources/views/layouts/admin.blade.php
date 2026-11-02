<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - NusaCandle Admin</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .display-font { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen bg-[#f5f7f4] text-[#183b2c]">

    <div class="min-h-screen grid grid-cols-[244px_1fr]">
        
        {{-- Sidebar --}}
        <x-admin.sidebar />

        <main class="min-w-0">
            {{-- Navbar --}}
            <x-admin.navbar />

            <!-- Konten Utama -->
            <div class="mx-auto max-w-7xl space-y-6 px-5 py-7 sm:px-9 sm:py-9">
                
                {{-- Notifikasi --}}
                @if (session('success'))
                    <div role="status" class="border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div role="alert" class="border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 rounded-md">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Konten Halaman --}}
                @yield('content')
                
            </div>
        </main>
    </div>

</body>
</html>