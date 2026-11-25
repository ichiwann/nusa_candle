@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Admin')

@section('content')
    @php
        $totalOrders = array_sum($chartData['orders']);
    @endphp

    <div class="admin-dashboard text-[#29261e]">
        <section class="dashboard-heading mb-5 min-h-20 bg-white px-4 py-4 md:px-6">
            <h1 class="display-font text-3xl font-semibold leading-tight text-[#29261e]">Dashboard Admin</h1>
            <p class="mt-1 text-sm text-[#77736b]">Lilin Aroma Terapi Aroma Apel Malang (Signature Edition).</p>
        </section>

        <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4" aria-label="Ringkasan dashboard">
            <a href="{{ route('admin.products.index') }}" class="dashboard-stat-card block min-h-[96px] min-w-0 border-l-[3px] border-[#416b52] bg-white p-2.5 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka manajemen produk" title="Buka manajemen produk">
                <div class="mb-1.5 flex items-start justify-between gap-2">
                    <p class="text-[8px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Total Produk</p>
                    <span class="flex h-5 w-5 items-center justify-center bg-[#edf0e7] text-[#537056]">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-xl font-semibold leading-none text-[#29261e]">{{ number_format($totalProducts) }}</p>
                <p class="mt-1 text-[10px] leading-tight text-[#77736b]">Produk terdaftar di katalog</p>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="dashboard-stat-card block min-h-[96px] min-w-0 border-l-[3px] border-[#b4262d] bg-white p-2.5 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka daftar pesanan" title="Buka daftar pesanan">
                <div class="mb-1.5 flex items-start justify-between gap-2">
                    <p class="text-[8px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Total Pesanan</p>
                    <span class="flex h-5 w-5 items-center justify-center bg-[#fbe6e4] text-[#b3262d]">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-xl font-semibold leading-none text-[#29261e]">{{ number_format($totalOrders) }}</p>
                <p class="mt-1 text-[10px] leading-tight text-[#77736b]">Pesanan dalam 7 minggu</p>
            </a>

            <a href="{{ route('admin.payments.index') }}" class="dashboard-stat-card block min-h-[96px] min-w-0 border-l-[3px] border-[#416b52] bg-white p-2.5 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka daftar pembayaran" title="Buka daftar pembayaran">
                <div class="mb-1.5 flex items-start justify-between gap-2">
                    <p class="text-[8px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Total Pembayaran</p>
                    <span class="flex h-5 w-5 items-center justify-center bg-[#d8f0d2] text-[#3d7b45]">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18v10H3zM7 11h.01M17 13h.01M12 10a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-xl font-semibold leading-tight text-[#29261e]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="mt-1 text-[10px] leading-tight text-[#77736b]">Pendapatan pesanan selesai</p>
            </a>

            <a href="{{ route('admin.hadiah.index') }}" class="dashboard-stat-card block min-h-[96px] min-w-0 border-l-[3px] border-[#416b52] bg-white p-2.5 text-left transition duration-150 hover:-translate-y-0.5 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#a51f27]" aria-label="Buka pengelolaan hadiah poin" title="Buka pengelolaan hadiah poin">
                <div class="mb-1.5 flex items-start justify-between gap-2">
                    <p class="text-[8px] font-semibold uppercase tracking-[0.08em] text-[#625f56]">Poin Nusa Berjalan</p>
                    <span class="flex h-5 w-5 items-center justify-center bg-[#edf0e7] text-[#537056]">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l2.2 4.5 5 .7-3.6 3.5.8 5-4.4-2.4-4.4 2.4.8-5-3.6-3.5 5-.7L12 3z"/>
                        </svg>
                    </span>
                </div>
                <p class="display-font text-xl font-semibold leading-none text-[#29261e]">{{ number_format($totalPoints) }}</p>
                <p class="mt-1 text-[10px] leading-tight text-[#77736b]">Poin aktif member</p>
            </a>
        </section>

        <section class="dashboard-chart mt-5 min-h-[390px] bg-white p-5 md:p-6">
            <div class="mb-3 flex items-start justify-between gap-6">
                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#42634f]">Analitika Kurva Artisan Tunggal</p>
                    <h2 class="display-font mt-2 text-2xl font-semibold leading-tight text-[#29261e]">Grafik Penjualan Lilin Apel<br class="hidden sm:block"> Malang</h2>
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

            const adminMain = appShell.querySelector('main');

            if (adminMain) {
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
            'Minggu 1',
            'Minggu 2',
            'Minggu 3',
            'Minggu 4',
            'Minggu 5',
            'Minggu 6',
            'Minggu 7',
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
