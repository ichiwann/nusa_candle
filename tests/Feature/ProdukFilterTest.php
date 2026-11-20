<?php

use App\Models\Produk;
use App\Models\User;

test('admin product list filters products by stock status', function (string $stockStatus, string $visibleProduct, string $hiddenProduct) {
    $admin = User::factory()->create(['role' => 'admin']);

    $availableProduct = new Produk([
        'nama_produk' => 'Produk Tersedia',
        'harga' => 100000,
        'stok' => 5,
    ]);
    $availableProduct->id_produk = 1000001;
    $availableProduct->save();

    $outOfStockProduct = new Produk([
        'nama_produk' => 'Produk Habis',
        'harga' => 90000,
        'stok' => 0,
    ]);
    $outOfStockProduct->id_produk = 1000002;
    $outOfStockProduct->save();

    $response = $this->actingAs($admin)
        ->get(route('admin.products.index', ['stock_status' => $stockStatus]));

    $response
        ->assertOk()
        ->assertSee($visibleProduct)
        ->assertDontSee($hiddenProduct);
})->with([
    'available stock' => ['tersedia', 'Produk Tersedia', 'Produk Habis'],
    'out of stock' => ['habis', 'Produk Habis', 'Produk Tersedia'],
]);

test('admin product list filters products by the Malang apple theme', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $appleProduct = new Produk([
        'nama_produk' => 'Lilin Apel Malang Signature',
        'harga' => 125000,
        'stok' => 5,
    ]);
    $appleProduct->id_produk = 1000001;
    $appleProduct->save();

    $otherProduct = new Produk([
        'nama_produk' => 'Lilin Lavender',
        'harga' => 90000,
        'stok' => 5,
    ]);
    $otherProduct->id_produk = 1000002;
    $otherProduct->save();

    $response = $this->actingAs($admin)
        ->get(route('admin.products.index', ['theme' => 'apel_malang']));

    $response
        ->assertOk()
        ->assertSee('Lilin Apel Malang Signature')
        ->assertDontSee('Lilin Lavender');
});

test('admin product list searches by numeric product ID', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $matchingProduct = new Produk([
        'nama_produk' => 'Lilin Apel Signature',
        'harga' => 125000,
        'stok' => 5,
    ]);
    $matchingProduct->id_produk = 1000001;
    $matchingProduct->save();

    $otherProduct = new Produk([
        'nama_produk' => 'Lilin Lavender',
        'harga' => 90000,
        'stok' => 5,
    ]);
    $otherProduct->id_produk = 1000002;
    $otherProduct->save();

    $response = $this->actingAs($admin)
        ->get(route('admin.products.index', ['search' => '1000001']));

    $response
        ->assertOk()
        ->assertSee('Lilin Apel Signature')
        ->assertDontSee('Lilin Lavender');
});

test('admin product details do not offer a delete action', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('admin.products.index'));

    $response
        ->assertOk()
        ->assertDontSee('Hapus Produk')
        ->assertDontSee('hapus-produk-form')
        ->assertSee('Tutup');
});
