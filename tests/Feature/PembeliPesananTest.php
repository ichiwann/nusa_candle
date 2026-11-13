<?php

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;

test('orders page displays preview cards when there is no order history', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('pembeli.pesanan.index'));

    $response
        ->assertOk()
        ->assertSee('Pesanan Saya')
        ->assertSee('Contoh')
        ->assertSee('#NC-2024-8841')
        ->assertSee('NusaCandle - Lilin Aroma Terapi Aroma Apel')
        ->assertSee('href="' . route('pembeli.pesanan.preview', 8841) . '"', false);
});

test('sample order detail opens the buyer detail page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('pembeli.pesanan.preview', 8841));

    $response
        ->assertOk()
        ->assertViewIs('pages.pembeli.pembeli_detail_pesanan')
        ->assertViewHas('isPreview', true)
        ->assertSee('#NC-2024-8841')
        ->assertSee('NusaCandle - Lilin Aroma Terapi Aroma Apel')
        ->assertSee('Ini pratinjau pesanan contoh')
        ->assertSee('Tindakan pembayaran tidak tersedia untuk pesanan contoh.');
});

test('unknown sample order detail returns not found', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('pembeli.pesanan.preview', 9999))
        ->assertNotFound();
});

test('order detail displays payment and product information', function () {
    $user = User::factory()->create();

    $produk = new Produk([
        'nama_produk' => 'Lilin Aroma Apel',
        'stok' => 5,
        'harga' => 89000,
    ]);
    $produk->id_produk = 1;
    $produk->save();

    $pesanan = Pesanan::create([
        'id_user' => $user->id_user,
        'total_harga' => 109000,
        'status_pesanan' => 'menunggu_pembayaran',
    ]);

    DetailPesanan::create([
        'id_pesanan' => $pesanan->id_pesanan,
        'id_produk' => $produk->id_produk,
        'jumlah' => 1,
        'harga_satuan' => 89000,
    ]);

    Transaksi::create([
        'id_pesanan' => $pesanan->id_pesanan,
        'metode_pembayaran' => 'bca',
        'status_pembayaran' => 'menunggu',
    ]);

    $detailUrl = route('pembeli.pesanan.show', $pesanan->id_pesanan);

    $this->actingAs($user)
        ->get(route('pembeli.pesanan.index'))
        ->assertOk()
        ->assertSee('href="' . $detailUrl . '"', false)
        ->assertSee('Lihat Detail');

    $response = $this->get($detailUrl);

    $response
        ->assertOk()
        ->assertSee('Lilin Aroma Apel')
        ->assertSee('Transfer Bank BCA')
        ->assertSee('Informasi Pengiriman')
        ->assertSee('Nomor Virtual Account / Rekening Tujuan')
        ->assertSee('Rp89.000');
});
