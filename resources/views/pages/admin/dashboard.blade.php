@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Admin')

@section('content')
    <!-- Header Dashboard -->
    <div class="mb-6">
        <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Admin Ledger</p>
        <h1 class="display-font mt-1 text-3xl font-semibold text-[#183b2c]">Dashboard Admin</h1>
        <p class="mt-2 max-w-2xl text-sm text-[#718078]">
            Ringkasan penjualan, stok, dan performa toko NusaCandle. Pantau produk unggulan, distribusi pesanan, dan tren penjualan mingguan.
        </p>
    </div>

    <!-- Stats Cards -->
    <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5 mb-6">
        <!-- Total Produk -->
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Total Produk</p>
                <svg class="w-4 h-4 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <p class="display-font text-3xl font-semibold text-[#183b2c]">{{ number_format($totalProducts) }}</p>
            <p class="mt-1 text-[11px] text-[#87948b]">Lilin Aromaterapi</p>
            <div class="mt-3 flex items-center gap-1 text-[10px] text-emerald-700 bg-emerald-50 px-2 py-1 rounded">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>+2 minggu ini</span>
            </div>
        </article>

        <!-- Total Member -->
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Total Member</p>
                <svg class="w-4 h-4 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <p class="display-font text-3xl font-semibold text-[#183b2c]">{{ number_format($totalMembers) }}</p>
            <p class="mt-1 text-[11px] text-[#87948b]">Pelanggan Terdaftar</p>
            <div class="mt-3 flex items-center gap-1 text-[10px] text-red-700 bg-red-50 px-2 py-1 rounded">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
                <span>-1.5% vs bulan lalu</span>
            </div>
        </article>

        <!-- Pendapatan -->
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Pendapatan</p>
                <svg class="w-4 h-4 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="display-font text-3xl font-semibold text-[#183b2c]">Rp {{ number_format($totalRevenue / 1000000, 1) }}M</p>
            <p class="mt-1 text-[11px] text-[#87948b]">Penjualan Lilin Apel</p>
            <div class="mt-3 flex items-center gap-1 text-[10px] text-emerald-700 bg-emerald-50 px-2 py-1 rounded">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>+12.5% bulan ini</span>
            </div>
        </article>

        <!-- Stok Terjual -->
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Stok Terjual</p>
                <svg class="w-4 h-4 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <p class="display-font text-3xl font-semibold text-[#183b2c]">{{ number_format($totalSold) }}</p>
            <p class="mt-1 text-[11px] text-[#87948b]">Unit Terjual</p>
            <div class="mt-3 flex items-center gap-1 text-[10px] text-red-700 bg-red-50 px-2 py-1 rounded">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
                <span>-5.2% minggu ini</span>
            </div>
        </article>

        <!-- Penjualan -->
        <article class="border border-[#e8eee8] bg-white p-5 rounded-md shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[10px] font-semibold uppercase tracking-[0.13em] text-[#718078]">Penjualan</p>
                <svg class="w-4 h-4 text-[#718078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <p class="display-font text-3xl font-semibold text-[#183b2c]">{{ number_format($totalMembers * 15) }}</p>
            <p class="mt-1 text-[11px] text-[#87948b]">Total Transaksi</p>
            <div class="mt-3 flex items-center gap-1 text-[10px] text-emerald-700 bg-emerald-50 px-2 py-1 rounded">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>+8.3% bulan ini</span>
            </div>
        </article>
    </section>

    <!-- Chart Section -->
    <section class="border border-[#e8eee8] bg-white rounded-md shadow-sm p-6">
        <div class="mb-6">
            <p class="text-[9px] font-semibold uppercase tracking-[0.17em] text-[#64835d]">Analisis Penjualan</p>
            <h2 class="display-font mt-1 text-2xl font-semibold text-[#183b2c]">Tren Penjualan Lilin Apel Malang</h2>
            <p class="mt-1 text-xs text-[#7b887f]">Perbandingan pendapatan dan jumlah pesanan 7 minggu terakhir</p>
        </div>

        <div class="relative h-80">
            <canvas id="salesChart"></canvas>
        </div>

        <div class="mt-6 flex items-center justify-center gap-6 text-xs">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
                <span class="text-[#718078]">Pendapatan Lilin Apel (Juta Rp)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <span class="text-[#718078]">Volume Terjual (pcs)</span>
            </div>
        </div>
    </section>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        const chartData = @json($chartData);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Pendapatan (Juta Rp)',
                        data: chartData.revenue.map(v => v / 1000000),
                        borderColor: '#059669',
                        backgroundColor: 'rgba(5, 150, 105, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Volume Terjual (pcs)',
                        data: chartData.orders,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#103a2a',
                        titleFont: { family: 'Playfair Display' },
                        bodyFont: { family: 'DM Sans' },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { family: 'DM Sans', size: 11 },
                            color: '#718078'
                        }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: {
                            color: '#e8eee8'
                        },
                        ticks: {
                            font: { family: 'DM Sans', size: 11 },
                            color: '#718078',
                            callback: function(value) {
                                return value + 'M';
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        },
                        ticks: {
                            font: { family: 'DM Sans', size: 11 },
                            color: '#718078'
                        }
                    }
                }
            }
        });
    </script>
@endsection