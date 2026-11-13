<?php

use App\Models\Produk;
use App\Models\User;

test('adding a product redirects to the cart', function () {
    $user = User::factory()->create();

    $produk = new Produk([
        'nama_produk' => 'Lilin Aroma Apel',
        'stok' => 5,
        'harga' => 50000,
    ]);
    $produk->id_produk = 1;
    $produk->save();

    $response = $this->actingAs($user)->post(route('keranjang.store'), [
        'id_produk' => $produk->id_produk,
        'jumlah' => 1,
    ]);

    $response
        ->assertRedirect(route('keranjang.index'))
        ->assertSessionHas('success', 'Produk berhasil ditambahkan ke keranjang.');

    $this->assertDatabaseHas('keranjang', [
        'id_user' => $user->id_user,
        'id_produk' => $produk->id_produk,
        'jumlah' => 1,
    ]);
});
