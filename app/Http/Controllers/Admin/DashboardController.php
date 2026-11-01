<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $hasUserTable = Schema::hasTable('user');
        $hasProductTable = Schema::hasTable('produk');
        $hasOrderTable = Schema::hasTable('pesanan');

        return view('pages.admin.dashboard', [
            'totalUsers' => $hasUserTable ? DB::table('user')->where('role', 'pembeli')->count() : 0,
            'totalPoints' => $hasUserTable
                ? (int) DB::table('user')->where('role', 'pembeli')->sum('total_poin')
                : 0,
            'totalProducts' => $hasProductTable ? DB::table('produk')->count() : 0,
            'pendingOrders' => $hasOrderTable
                ? DB::table('pesanan')->where('status_pesanan', 'menunggu_pembayaran')->count()
                : 0,
            'topUsers' => $hasUserTable
                ? DB::table('user')
                    ->where('role', 'pembeli')
                    ->orderByDesc('total_poin')
                    ->limit(5)
                    ->get(['nama_lengkap', 'total_poin'])
                : collect(),
        ]);
    }
}
