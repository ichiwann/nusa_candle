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
    
</head>
<body class="font-buyer flex min-h-screen flex-col bg-[#FAF9F6] text-[#2C1810] print:bg-white">

    {{-- Navbar Component --}}
    <x-pembeli.navbar />

    {{-- Konten Utama (flex-grow agar footer selalu di bawah jika konten sedikit) --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer Component --}}
    <x-pembeli.footer />

</body>
</html>