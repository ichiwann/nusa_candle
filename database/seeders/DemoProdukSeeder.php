<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class DemoProdukSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['id_produk' => 9900001, 'nama_produk' => 'Lilin Aroma Apel Signature', 'harga' => 125000, 'stok' => 45],
            ['id_produk' => 9900002, 'nama_produk' => 'Lilin Aroma Apel Classic', 'harga' => 110000, 'stok' => 32],
            ['id_produk' => 9900003, 'nama_produk' => 'Jar Amber Apel Botanical', 'harga' => 150000, 'stok' => 4],
            ['id_produk' => 9900004, 'nama_produk' => 'Lilin Apel Malang Relax', 'harga' => 135000, 'stok' => 18],
            ['id_produk' => 9900005, 'nama_produk' => 'Lilin Apel Malang Premium', 'harga' => 175000, 'stok' => 0],
            ['id_produk' => 9900006, 'nama_produk' => 'Candle Apel Orchard', 'harga' => 160000, 'stok' => 27],
            ['id_produk' => 9900007, 'nama_produk' => 'Lilin Apel Malang Travel', 'harga' => 85000, 'stok' => 13],
            ['id_produk' => 9900008, 'nama_produk' => 'Jar Kaca Apel Malang', 'harga' => 145000, 'stok' => 50],
            ['id_produk' => 9900009, 'nama_produk' => 'Lilin Apel Malang Gift Set', 'harga' => 225000, 'stok' => 8],
            ['id_produk' => 9900010, 'nama_produk' => 'Apel Malang Mini Candle', 'harga' => 75000, 'stok' => 3],
        ];

        foreach ($products as $productData) {
            $product = Produk::query()->find($productData['id_produk']) ?? new Produk;
            $product->fill([
                'nama_produk' => $productData['nama_produk'],
                'harga' => $productData['harga'],
                'stok' => $productData['stok'],
            ]);
            $product->id_produk = $productData['id_produk'];
            $product->save();
        }
    }
}
