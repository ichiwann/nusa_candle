<?php

use App\Models\User;

test('sample payment details open from the payment list', function () {
    $user = User::factory()->create();
    $detailUrl = route('pembeli.transaksi.index', ['demo_transaction' => 99412]);
    $historyDetailUrl = route('pembeli.transaksi.index', ['demo_transaction' => 92110]);

    $listResponse = $this->actingAs($user)->get(route('pembeli.transaksi.index'));

    $listResponse
        ->assertOk()
        ->assertSee('Pembayaran Saya')
        ->assertSee('Riwayat Pembayaran')
        ->assertSee('href="'.$detailUrl.'"', false)
        ->assertSee('href="'.$historyDetailUrl.'"', false);

    $detailResponse = $this->get($detailUrl);

    $detailResponse
        ->assertOk()
        ->assertSee('Detail Pembayaran')
        ->assertSee('Ini pratinjau pembayaran contoh.')
        ->assertSee('TRX-99412');

    $historyResponse = $this->get($historyDetailUrl);

    $historyResponse
        ->assertOk()
        ->assertSee('TRX-92110')
        ->assertSee('Pembayaran Berhasil Diverifikasi');
});
