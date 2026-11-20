<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class DemoPesananSeeder extends Seeder
{
    private const DEMO_BUYERS = [
        ['name' => 'Dian Pratiwi', 'username' => 'demo_dian_pratiwi'],
        ['name' => 'Bagus Satrio P.', 'username' => 'demo_bagus_satrio'],
        ['name' => 'Aya Widiana', 'username' => 'demo_aya_widiana'],
        ['name' => 'Hendra Kusuma', 'username' => 'demo_hendra_kusuma'],
        ['name' => 'Ratu Kumala', 'username' => 'demo_ratu_kumala'],
        ['name' => 'Fajar Ramadhan', 'username' => 'demo_fajar_ramadhan'],
        ['name' => 'Siti Rahmawati', 'username' => 'demo_siti_rahmawati'],
        ['name' => 'Dimas Anggara', 'username' => 'demo_dimas_anggara'],
        ['name' => 'Dewi Kartika', 'username' => 'demo_dewi_kartika'],
    ];

    public function run(): void
    {
        $products = Produk::query()->orderBy('id_produk')->get();

        if ($products->isEmpty()) {
            throw new RuntimeException('Tambahkan produk terlebih dahulu sebelum membuat pesanan demo.');
        }

        DB::transaction(function () use ($products): void {
            $buyers = $this->createDemoBuyers();
            $demoUserIds = collect($buyers)->pluck('id_user');
            $existingOrderCount = DB::table('pesanan')->count();
            $existingDemoOrderCount = DB::table('pesanan')
                ->whereIn('id_user', $demoUserIds)
                ->count();

            if ($existingOrderCount !== $existingDemoOrderCount) {
                throw new RuntimeException('DemoPesananSeeder tidak mengubah pesanan yang bukan milik akun demo.');
            }

            if ($existingDemoOrderCount === 10) {
                return;
            }

            if ($existingDemoOrderCount > 0) {
                DB::table('pesanan')->whereIn('id_user', $demoUserIds)->delete();
            }

            /** @var list<array{id: int, buyer: int, status: string, created_at: string, quantity: int, total: int, product_index: int}> $ordersToSeed */
            $ordersToSeed = [
                ['id' => 891, 'buyer' => 0, 'status' => 'diproses', 'created_at' => '2025-03-24 09:30:00', 'quantity' => 2, 'total' => 250000, 'product_index' => 0],
                ['id' => 892, 'buyer' => 1, 'status' => 'menunggu_pembayaran', 'created_at' => '2025-03-24 09:00:00', 'quantity' => 3, 'total' => 225000, 'product_index' => 9],
                ['id' => 890, 'buyer' => 2, 'status' => 'dikirim', 'created_at' => '2025-03-23 09:00:00', 'quantity' => 1, 'total' => 95000, 'product_index' => 6],
                ['id' => 888, 'buyer' => 3, 'status' => 'selesai', 'created_at' => '2025-03-22 12:00:00', 'quantity' => 4, 'total' => 500000, 'product_index' => 0],
                ['id' => 885, 'buyer' => 4, 'status' => 'dibatalkan', 'created_at' => '2025-03-21 11:00:00', 'quantity' => 1, 'total' => 75000, 'product_index' => 9],
                ['id' => 884, 'buyer' => 5, 'status' => 'diproses', 'created_at' => '2025-03-21 10:00:00', 'quantity' => 2, 'total' => 270000, 'product_index' => 3],
                ['id' => 883, 'buyer' => 6, 'status' => 'dikirim', 'created_at' => '2025-03-20 15:00:00', 'quantity' => 5, 'total' => 625000, 'product_index' => 0],
                ['id' => 882, 'buyer' => 7, 'status' => 'menunggu_pembayaran', 'created_at' => '2025-03-20 12:00:00', 'quantity' => 1, 'total' => 95000, 'product_index' => 6],
                ['id' => 881, 'buyer' => 8, 'status' => 'selesai', 'created_at' => '2025-03-19 10:00:00', 'quantity' => 2, 'total' => 225000, 'product_index' => 1],
                ['id' => 880, 'buyer' => 4, 'status' => 'dibatalkan', 'created_at' => '2025-03-19 09:00:00', 'quantity' => 1, 'total' => 95000, 'product_index' => 6],
            ];

            if (count($ordersToSeed) !== 10) {
                throw new RuntimeException('Seeder demo harus berisi tepat 10 pesanan.');
            }

            $orders = [];
            $details = [];
            $transactions = [];
            $paymentMethods = ['bca', 'mandiri', 'gopay', 'dana', 'shopeepay', 'cod'];

            foreach ($ordersToSeed as $orderSpecification) {
                $createdAt = $orderSpecification['created_at'];
                $product = $products[$orderSpecification['product_index'] % $products->count()];

                $orders[] = [
                    'id_pesanan' => $orderSpecification['id'],
                    'id_user' => $buyers[$orderSpecification['buyer']]->id_user,
                    'total_harga' => $orderSpecification['total'],
                    'status_pesanan' => $orderSpecification['status'],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];

                $details[] = [
                    'id_pesanan' => $orderSpecification['id'],
                    'id_produk' => $product->id_produk,
                    'jumlah' => $orderSpecification['quantity'],
                    'harga_satuan' => intdiv($orderSpecification['total'], $orderSpecification['quantity']),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];

                $transactions[] = [
                    'id_pesanan' => $orderSpecification['id'],
                    'metode_pembayaran' => $paymentMethods[$orderSpecification['id'] % count($paymentMethods)],
                    'status_pembayaran' => match ($orderSpecification['status']) {
                        'menunggu_pembayaran' => 'menunggu',
                        'dibatalkan' => 'gagal',
                        default => 'berhasil',
                    },
                    'bukti_pembayaran' => null,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
            }

            DB::table('pesanan')->insert($orders);
            DB::table('detail_pesanan')->insert($details);
            DB::table('transaksi')->insert($transactions);
        });
    }

    /**
     * @return list<User>
     */
    private function createDemoBuyers(): array
    {
        return array_map(function (array $buyer): User {
            return User::query()->firstOrCreate(
                ['username' => $buyer['username']],
                [
                    'nama_lengkap' => $buyer['name'],
                    'email' => $buyer['username'].'@example.test',
                    'alamat' => 'Malang, Jawa Timur',
                    'password' => Hash::make(Str::random(40)),
                    'role' => 'pembeli',
                    'total_poin' => 0,
                ],
            );
        }, self::DEMO_BUYERS);
    }
}
