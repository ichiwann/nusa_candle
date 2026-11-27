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

    <div @class([
        'min-h-screen grid',
        'grid-cols-1 md:grid-cols-[250px_minmax(0,1fr)]' => request()->routeIs('admin.*'),
        'grid-cols-[244px_1fr]' => !request()->routeIs('admin.*'),
    ])>

        {{-- Sidebar (desktop) + Drawer (mobile) --}}
        <x-admin.sidebar />

        {{-- Kolom kanan: navbar + konten. flex-col agar navbar menempel penuh ke sidebar --}}
        <main class="flex min-w-0 flex-col">
            @if (request()->routeIs('admin.dashboard'))
                <x-admin.navbar :total-orders="array_sum($chartData['orders'])" />
            @else
                <x-admin.navbar />
            @endif

            {{-- Notifikasi global --}}
            @if (session('success') || $errors->any())
                <div class="w-full px-4 pt-4 sm:px-6 lg:px-8 xl:px-12">
                    @if (session('success'))
                        <div role="status"
                            class="mb-3 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div role="alert"
                            class="mb-3 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <ul class="list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endif

            {{-- Konten utama --}}
            <div class="w-full px-4 py-6 sm:px-6 sm:py-9 lg:px-8 xl:px-12">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>