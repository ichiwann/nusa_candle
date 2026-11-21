<?php

use App\Models\Produk;
use App\Models\User;

test('product detail renders cart action without buy now action', function () {
    $user = User::factory()->create(['role' => 'pembeli']);
    $product = new Produk([
        'nama_produk' => 'Lilin Apel Malang',
        'harga' => 150000,
        'stok' => 5,
    ]);
    $product->id_produk = 1000001;
    $product->save();

    $response = $this->actingAs($user)
        ->get(route('produk.show', $product->id_produk));

    $response
        ->assertOk()
        ->assertSee('Tambah ke Keranjang')
        ->assertDontSee('Beli Sekarang');
});

test('product preview renders cart action without buy now action', function () {
    $user = User::factory()->create(['role' => 'pembeli']);

    $response = $this->actingAs($user)
        ->get(route('produk.preview', 0));

    $response
        ->assertOk()
        ->assertSee('Tambah ke Keranjang')
        ->assertDontSee('Beli Sekarang');
});
