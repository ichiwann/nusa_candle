@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Admin')

@section('content')
    @php
        $totalOrders = array_sum($chartData['orders']);
    @endphp

    <div class="admin-dashboard text-[#29261e]">
        <header class="dashboard-topbar -mx-4 flex h-14 items-center justify-between border-b border-[#ece5d7] bg-[#fffaf0] px-4 md:-mx-8 md:px-8">
            <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-[#42634f]">Admin Ledger <span class="text-[#9b9b8c]">›</span></p>

            <div class="flex items-center gap-4">
                <div class="relative" data-dashboard-dropdown>
                    <button id="dashboard-notifications-toggle" type="button" class="relative flex h-9 w-9 items-center justify-center text-[#354735] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka ringkasan aktivitas" aria-controls="dashboard-notifications" aria-expanded="false">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M10 2a4 4 0 00-4 4v1.18c0 .53-.21 1.04-.59 1.41L4.3 9.7A1 1 0 005 11.4h10a1 1 0 00.7-1.7l-1.11-1.11A2 2 0 0114 7.18V6a4 4 0 00-4-4zM8 13a2 2 0 104 0H8z"/>
                        </svg>
                        @if ($totalOrders > 0)
                            <span class="absolute right-1 top-1 h-1.5 w-1.5 rounded-full bg-[#ad2028]"></span>
                        @endif
                    </button>
                    <div id="dashboard-notifications" class="dashboard-menu absolute right-0 top-[calc(100%+6px)] z-[60] hidden w-72 max-w-[calc(100vw-32px)] border border-[#e8e2d6] bg-white p-4 shadow-lg" role="region" aria-labelledby="dashboard-notifications-toggle">
                        <p class="text-sm font-semibold text-[#302d27]">Aktivitas 7 minggu terakhir</p>
                        @if ($totalOrders > 0)
                            <p class="mt-2 text-xs leading-relaxed text-[#625f56]">
                                Ada {{ number_format($totalOrders) }} pesanan selesai pada periode grafik.
                            </p>
                        @else
                            <p class="mt-2 text-xs leading-relaxed text-[#625f56]">Belum ada pesanan selesai pada periode grafik.</p>
                        @endif
                        <a href="{{ route('admin.orders.index') }}" class="mt-3 inline-flex text-xs font-semibold text-[#8b1e1e] hover:underline">
                            Lihat pesanan
                        </a>
                    </div>
                </div>
                <span class="h-5 border-l border-[#e8dfd1]"></span>
                <div class="relative" data-dashboard-dropdown>
                    <button id="dashboard-account-toggle" type="button" class="flex items-center gap-2 text-left focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka menu akun" aria-controls="dashboard-account-menu" aria-expanded="false">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#a51f27] text-sm font-semibold text-white">
                            {{ mb_substr(auth()->user()->nama_lengkap, 0, 1) }}
                        </span>
                        <span class="dashboard-account text-xs leading-[1.2]">
                            <span class="block font-semibold text-[#302d27]">{{ auth()->user()->nama_lengkap }}</span>
                            <span class="block text-[9px] uppercase tracking-[0.08em] text-[#77736b]">Administrator</span>
                        </span>
                        <svg class="h-3 w-3 text-[#77736b]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                    <div id="dashboard-account-menu" class="dashboard-menu absolute right-0 top-[calc(100%+6px)] z-[60] hidden w-72 max-w-[calc(100vw-32px)] border border-[#e8e2d6] bg-white p-2 shadow-lg" role="menu" aria-labelledby="dashboard-account-toggle">
                        <a href="{{ route('admin.settings.edit') }}" role="menuitem" class="block px-3 py-2 text-sm text-[#302d27] hover:bg-[#f7f4e9]">
                            Pengaturan Admin
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" role="menuitem" class="block w-full px-3 py-2 text-left text-sm text-[#8b1e1e] hover:bg-[#f7f4e9]">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <section class="dashboard-heading mb-5 min-h-20 bg-white px-4 py-4 md:px-6">
            <h1 class="display-font text-3xl font-semibold leading-tight text-[#29261e]">Dashboard Admin</h1>
            <p class="mt-1 text-sm text-[#77736b]">Lilin Aroma Terapi Aroma Apel Malang (Signature Edition).</p>
        </section>

        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5" aria-label="Ringkasan dashboard">
            <a href="{{ route('admin.products.index') }}" class="dashboard-stat-card block min-h-[132px] min-w-0 border-l-4 border-[#416b52] bg-white p-4 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka manajemen produk" title="Buka manajemen produk">
                <div class="mb-3 flex items-start justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Total Produk</p>
                    <span class="flex h-8 w-8 items-center justify-center bg-[#edf0e7] text-[#537056]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-2xl font-semibold leading-none text-[#29261e]">{{ number_format($totalProducts) }} Produk</p>
                <p class="mt-2 text-xs leading-tight text-[#77736b]">Desain kerajinan lokal Malang</p>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="dashboard-stat-card block min-h-[132px] min-w-0 border-l-4 border-[#b4262d] bg-white p-4 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka daftar pesanan" title="Buka daftar pesanan">
                <div class="mb-3 flex items-start justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Total Pesanan</p>
                    <span class="flex h-8 w-8 items-center justify-center bg-[#fbe6e4] text-[#b3262d]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-2xl font-semibold leading-none text-[#29261e]">{{ number_format($totalOrders) }}</p>
                <p class="mt-2 text-xs leading-tight text-[#77736b]">Pesanan dalam 7 minggu terakhir</p>
            </a>

            <a href="{{ route('admin.transactions.index') }}" class="dashboard-stat-card block min-h-[132px] min-w-0 border-l-4 border-[#416b52] bg-white p-4 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka daftar transaksi" title="Buka daftar transaksi">
                <div class="mb-3 flex items-start justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Total Pembayaran</p>
                    <span class="flex h-8 w-8 items-center justify-center bg-[#d8f0d2] text-[#3d7b45]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18v10H3zM7 11h.01M17 13h.01M12 10a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-xl font-semibold leading-tight text-[#29261e]">Rp {{ number_format($totalRevenue / 1000000, 1, ',', '.') }}M</p>
                <p class="mt-2 text-xs leading-tight text-[#77736b]">Penjualan Lilin Apel</p>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="dashboard-stat-card block min-h-[132px] min-w-0 border-l-4 border-[#b4262d] bg-white p-4 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka daftar pesanan terjual" title="Buka daftar pesanan terjual">
                <div class="mb-3 flex items-start justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Produk Terjual</p>
                    <span class="flex h-8 w-8 items-center justify-center bg-[#fbe6e4] text-[#b3262d]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-2xl font-semibold leading-none text-[#29261e]">{{ number_format($totalSold) }} Jar</p>
                <p class="mt-2 text-xs leading-tight text-[#77736b]">Bulan ini (Semua desain)</p>
            </a>

            <a href="{{ route('admin.hadiah.index') }}" class="dashboard-stat-card block min-h-[132px] min-w-0 border-l-4 border-[#416b52] bg-white p-4 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka pengelolaan hadiah poin" title="Buka pengelolaan hadiah poin">
                <div class="mb-3 flex items-start justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Poin Nusa Berjalan</p>
                    <span class="flex h-8 w-8 items-center justify-center bg-[#edf0e7] text-[#537056]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l2.2 4.5 5 .7-3.6 3.5.8 5-4.4-2.4-4.4 2.4.8-5-3.6-3.5 5-.7L12 3z"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-2xl font-semibold leading-none text-[#29261e]">{{ number_format($totalPoints) }}</p>
                <p class="mt-2 text-xs leading-tight text-[#77736b]">Sirkulasi Poin</p>
                <p class="text-xs leading-tight text-[#77736b]">Loyalty</p>
            </a>
        </section>

        <section class="dashboard-chart mt-5 min-h-[390px] bg-white p-5 md:p-6">
            <div class="mb-3 flex items-start justify-between gap-6">
                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#42634f]">Analitika Kurva Artisan Tunggal</p>
                    <h2 class="display-font mt-2 text-2xl font-semibold leading-tight text-[#29261e]">Tren Penjualan Lilin Apel<br class="hidden sm:block"> Malang</h2>
                </div>
                <div class="mt-1 flex shrink-0 flex-col gap-2 text-[11px] font-semibold text-[#4c4a43]">
                    <button type="button" class="flex items-center gap-1.5 text-left hover:text-[#376539] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" data-chart-series="0" aria-pressed="true">
                        <span class="h-1.5 w-1.5 bg-[#376539]"></span>
                        <span>Pendapatan Lilin Apel (Juta Rp)</span>
                    </button>
                    <button type="button" class="flex items-center gap-1.5 text-left hover:text-[#b31d28] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" data-chart-series="1" aria-pressed="true">
                        <span class="h-1.5 w-1.5 bg-[#b31d28]"></span>
                        <span>Volume Terjual (Jar)</span>
                    </button>
                </div>
            </div>

            <div class="relative h-[280px] sm:h-[320px]">
                <canvas id="salesChart" aria-label="Grafik tren penjualan tujuh minggu terakhir"></canvas>
            </div>
            <p id="chart-detail" class="mt-2 min-h-5 text-[11px] text-[#77736b]" role="status" aria-live="polite">
                Klik titik pada grafik untuk melihat rincian minggu tersebut.
            </p>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const appShell = document.querySelector('body > div.min-h-screen.grid');

        if (appShell) {
            document.body.classList.remove('bg-[#f5f7f4]');
            document.body.classList.add('box-border', 'min-h-screen', 'bg-[#f3f3f3]', 'p-0');

            appShell.classList.remove(
                'min-h-screen',
                'grid-cols-[244px_1fr]',
                'mx-auto',
                'w-full',
                'min-h-[calc(100vh-24px)]',
                'grid-cols-1',
                'overflow-hidden',
                'bg-[#f7f4e9]',
                'shadow-sm',
                'md:w-[92vw]',
                'md:max-w-[1260px]',
                'md:min-h-[calc(100vh-75px)]',
                'md:grid-cols-[175px_minmax(0,1fr)]',
            );
            appShell.classList.add(
                'w-full',
                'min-h-screen',
                'grid-cols-1',
                'overflow-hidden',
                'bg-[#f7f4e9]',
                'md:grid-cols-[250px_minmax(0,1fr)]',
            );

            const sidebar = appShell.querySelector('aside');
            const adminMain = appShell.querySelector('main');

            if (sidebar) {
                sidebar.classList.remove('px-5', 'py-5', 'bg-[#103a2a]', 'lg:min-h-screen');
                sidebar.classList.add('hidden', 'px-5', 'py-6', 'bg-[#153f2e]', 'md:flex', 'md:min-h-screen');

                const brand = sidebar.querySelector('a');
                if (brand) {
                    brand.classList.remove('flex-col', 'pb-6');
                    brand.classList.add('flex-row', 'justify-start', 'gap-3', 'px-1', 'pb-6');

                    const logo = brand.querySelector('img');
                    if (logo) {
                        logo.classList.remove('w-16', 'h-16', 'mb-3');
                        logo.classList.add('w-12', 'h-12', 'mb-0');
                    }

                    const brandText = brand.querySelectorAll('span');
                    if (brandText[0]) {
                        brandText[0].classList.remove('text-xl');
                        brandText[0].classList.add('text-lg', 'leading-[1.1]');
                    }
                    if (brandText[1]) {
                        brandText[1].classList.remove('mt-1', 'text-[9px]', 'tracking-[0.18em]');
                        brandText[1].classList.add('mt-1', 'text-[10px]', 'tracking-[0.12em]');
                    }
                }

                const sidebarNav = sidebar.querySelector('nav');
                if (sidebarNav) {
                    sidebarNav.classList.remove('mt-7', 'space-y-7');
                    sidebarNav.classList.add('mt-7', 'space-y-8');
                    sidebarNav.querySelectorAll('p').forEach(label => {
                        label.classList.remove('mb-2', 'text-[9px]', 'tracking-[0.18em]');
                        label.classList.add('mb-2', 'text-[10px]', 'tracking-[0.12em]');
                    });
                    sidebarNav.querySelectorAll('a').forEach((link, index) => {
                        link.classList.remove('gap-3', 'px-3', 'py-2.5', 'py-2', 'text-sm', 'bg-[#315d41]', 'text-white', 'text-emerald-50/75');
                        link.classList.add('gap-3', 'px-3', 'py-2.5', 'text-sm');
                        if (index === 0) {
                            link.classList.add('border-l-[3px]', 'border-[#ae2527]', 'rounded-none', 'bg-[#f7f4e9]', 'text-[#153f2e]');
                        } else {
                            link.classList.add('text-emerald-50/75');
                        }
                    });
                    sidebarNav.querySelectorAll(':scope > div > div').forEach(group => {
                        group.classList.remove('text-sm');
                        group.classList.add('text-sm');
                    });
                    sidebarNav.querySelectorAll('a svg').forEach(icon => {
                        icon.classList.remove('w-4', 'h-4');
                        icon.classList.add('w-5', 'h-5');
                    });
                }

                const logoutButton = sidebar.querySelector('form button');
                if (logoutButton) {
                    logoutButton.classList.remove('gap-2', 'px-3', 'py-2', 'text-sm');
                    logoutButton.classList.add('gap-2', 'px-3', 'py-2.5', 'text-sm');
                    logoutButton.querySelectorAll('svg').forEach(icon => {
                        icon.classList.remove('w-4', 'h-4');
                        icon.classList.add('w-5', 'h-5');
                    });
                }

                const accountLabel = sidebar.lastElementChild ? sidebar.lastElementChild.querySelector('p') : null;
                if (accountLabel) {
                    accountLabel.classList.remove('text-[9px]', 'tracking-[0.18em]');
                    accountLabel.classList.add('text-[10px]', 'tracking-[0.12em]');
                }
            }

            if (adminMain) {
                const originalTopbar = adminMain.querySelector(':scope > header');
                if (originalTopbar) {
                    originalTopbar.classList.add('hidden');
                }

                const contentContainer = adminMain.querySelector(':scope > div');
                if (contentContainer) {
                    contentContainer.classList.remove('px-4', 'sm:px-6', 'lg:px-8', 'xl:px-12', 'py-6', 'sm:py-9');
                    contentContainer.classList.add('px-4', 'pb-8', 'bg-[#f7f4e9]', 'md:px-8');
                }
            }
        }

        const chartElement = document.getElementById('salesChart');
        const chartDetail = document.getElementById('chart-detail');
        const chartData = @json($chartData);
        const stageLabels = [
            ['Minggu 1', '(Panen Awal)'],
            'Minggu 2',
            ['Minggu 3', '(Distribusi)'],
            'Minggu 4',
            ['Minggu 5', '(Puncak Bumijaji)'],
            'Minggu 6',
            ['Minggu 7', '(Kini)'],
        ];

        if (chartElement && typeof Chart !== 'undefined') {
            const chartContext = chartElement.getContext('2d');

            const salesChart = new Chart(chartContext, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                            label: 'Pendapatan Lilin Apel (Juta Rp)',
                            data: chartData.revenue.map(value => value / 1000000),
                            borderColor: '#376539',
                            backgroundColor: 'rgba(55, 101, 57, 0.10)',
                            borderWidth: 2,
                            pointRadius: 0,
                            pointHoverRadius: 3,
                            tension: 0.2,
                            fill: true,
                            yAxisID: 'y',
                        },
                        {
                            label: 'Volume Terjual (Jar)',
                            data: chartData.orders,
                            borderColor: '#b31d28',
                            backgroundColor: 'rgba(179, 29, 40, 0.12)',
                            borderWidth: 2,
                            pointRadius: 2,
                            pointHoverRadius: 4,
                            tension: 0.2,
                            fill: true,
                            yAxisID: 'y1',
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    layout: {
                        padding: { top: 8, right: 3, bottom: 0, left: 3 },
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e211c',
                            titleFont: { family: 'Playfair Display', size: 12 },
                            bodyFont: { family: 'DM Sans', size: 11 },
                            padding: 10,
                            cornerRadius: 4,
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                            border: {
                                color: '#e8e2d6',
                            },
                            ticks: {
                                color: '#5e594f',
                                font: { family: 'DM Sans', size: 10 },
                                maxRotation: 0,
                                minRotation: 0,
                                autoSkip: false,
                                callback: function(value, index) {
                                    return stageLabels[index] ?? this.getLabelForValue(value);
                                },
                            },
                        },
                        y: {
                            type: 'linear',
                            position: 'left',
                            grid: {
                                color: '#eee9df',
                                borderDash: [2, 3],
                                drawTicks: false,
                            },
                            border: {
                                display: false,
                            },
                            ticks: {
                                display: false,
                            },
                        },
                        y1: {
                            type: 'linear',
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            },
                            border: {
                                display: false,
                            },
                            ticks: {
                                display: false,
                            },
                        },
                    },
                },
            });

            chartElement.addEventListener('click', event => {
                const [activePoint] = salesChart.getElementsAtEventForMode(
                    event,
                    'index',
                    { intersect: false },
                    true,
                );

                if (!activePoint || !chartDetail) {
                    return;
                }

                const weekIndex = activePoint.index;
                const weekLabel = stageLabels[weekIndex];
                const formattedWeek = Array.isArray(weekLabel) ? weekLabel.join(' ') : weekLabel;
                const formattedRevenue = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0,
                }).format(chartData.revenue[weekIndex] ?? 0);
                const weekOrders = new Intl.NumberFormat('id-ID').format(chartData.orders[weekIndex] ?? 0);

                chartDetail.textContent = `${formattedWeek} · Pendapatan ${formattedRevenue} · Pesanan ${weekOrders}`;
            });

            document.querySelectorAll('[data-chart-series]').forEach(button => {
                button.addEventListener('click', () => {
                    const seriesIndex = Number(button.dataset.chartSeries);
                    const isVisible = salesChart.isDatasetVisible(seriesIndex);

                    salesChart.setDatasetVisibility(seriesIndex, !isVisible);
                    salesChart.update();
                    button.setAttribute('aria-pressed', String(!isVisible));
                    button.classList.toggle('opacity-50', isVisible);
                });
            });
        }

        const dropdowns = [...document.querySelectorAll('[data-dashboard-dropdown]')];

        function closeDropdown(dropdown) {
            const toggle = dropdown.querySelector('button[aria-controls]');
            const menu = document.getElementById(toggle.getAttribute('aria-controls'));

            menu.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
        }

        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('button[aria-controls]');
            const menu = document.getElementById(toggle.getAttribute('aria-controls'));

            toggle.addEventListener('click', () => {
                const shouldOpen = menu.classList.contains('hidden');

                dropdowns.forEach(closeDropdown);
                if (shouldOpen) {
                    menu.classList.remove('hidden');
                    toggle.setAttribute('aria-expanded', 'true');
                }
            });
        });

        document.addEventListener('click', event => {
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    closeDropdown(dropdown);
                }
            });
        });

        document.addEventListener('keydown', event => {
            if (event.key !== 'Escape') {
                return;
            }

            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('button[aria-controls]');
                const menu = document.getElementById(toggle.getAttribute('aria-controls'));

                if (!menu.classList.contains('hidden')) {
                    closeDropdown(dropdown);
                    toggle.focus();
                }
            });
        });
    </script>
@endsection
