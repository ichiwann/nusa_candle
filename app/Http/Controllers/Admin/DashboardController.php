<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    // Ganti __invoke jadi index (ini yang paling umum dipakai di Laravel)
    public function index(): View
    {
        // Hitung statistik dasar
        $totalProducts = DB::table('produk')->count();
        $totalMembers = DB::table('user')->where('role', 'pembeli')->count();
        $totalPoints = (int) DB::table('user')->where('role', 'pembeli')->sum('total_poin');
        
        // Hitung pendapatan dari pesanan yang selesai
        $totalRevenue = DB::table('pesanan')
            ->where('status_pesanan', 'selesai')
            ->sum('total_harga');
        
        // Hitung stok terjual (total pesanan)
        $totalSold = DB::table('detail_pesanan')->sum('jumlah');
        
        // Data chart penjualan 7 minggu terakhir
        $chartData = $this->getWeeklySalesData();
        
        return view('pages.admin.dashboard', compact(
            'totalProducts',
            'totalMembers',
            'totalPoints',
            'totalRevenue',
            'totalSold',
            'chartData'
        ));
    }

    private function getWeeklySalesData(): array
    {
        $weeks = [];
        $labels = [];
        $revenue = [];
        $orders = [];

        for ($i = 6; $i >= 0; $i--) {
            $startDate = now()->subWeeks($i)->startOfWeek();
            $endDate = now()->subWeeks($i)->endOfWeek();
            
            $weekRevenue = DB::table('pesanan')
                ->where('status_pesanan', 'selesai')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('total_harga');
            
            $weekOrders = DB::table('pesanan')
                ->where('status_pesanan', 'selesai')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

            $weeks[] = $startDate->format('d M');
            $labels[] = 'Minggu ' . (7 - $i);
            $revenue[] = $weekRevenue;
            $orders[] = $weekOrders;
        }

        return [
            'labels' => $labels,
            'weeks' => $weeks,
            'revenue' => $revenue,
            'orders' => $orders,
        ];
    }
}