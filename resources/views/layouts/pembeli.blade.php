<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NusaCandle')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-stone-50 text-stone-800 antialiased flex flex-col min-h-screen">

    {{-- Panggil Navbar dari Components --}}
    @include('components.pembeli.navbar')

    {{-- Konten Halaman --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Panggil Footer dari Components --}}
    @include('components.pembeli.footer')

</body>
</html>