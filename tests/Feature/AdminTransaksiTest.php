<?php

use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\User;

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('admin can find a payment by its formatted order number', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $buyer = User::factory()->create();

    $pesanan = Pesanan::create([
        'id_user' => $buyer->id_user,
        'total_harga' => 125000,
        'status_pesanan' => 'diproses',
    ]);

    Transaksi::create([
        'id_pesanan' => $pesanan->id_pesanan,
        'metode_pembayaran' => 'bca',
        'status_pembayaran' => 'berhasil',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.payments.index', [
            'search' => '#NC-ORD-'.$pesanan->created_at->format('Y').'-'.str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT),
        ]));

    $response
        ->assertOk()
        ->assertSee('Manajemen Pembayaran')
        ->assertSee($buyer->nama_lengkap)
        ->assertDontSee('Tidak ada pembayaran ditemukan');
});

test('admin can find a payment by its formatted transaction number', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $buyer = User::factory()->create();

    $pesanan = Pesanan::create([
        'id_user' => $buyer->id_user,
        'total_harga' => 125000,
        'status_pesanan' => 'diproses',
    ]);

    $transaksi = Transaksi::create([
        'id_pesanan' => $pesanan->id_pesanan,
        'metode_pembayaran' => 'bca',
        'status_pembayaran' => 'berhasil',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.payments.index', [
            'search' => 'TRX-'.str_pad($transaksi->id_transaksi, 6, '0', STR_PAD_LEFT),
        ]));

    $response
        ->assertOk()
        ->assertSee($buyer->nama_lengkap)
        ->assertDontSee('Tidak ada pembayaran ditemukan');
});

test('admin can update a payment status and save an admin note', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $buyer = User::factory()->create();

    $pesanan = Pesanan::create([
        'id_user' => $buyer->id_user,
        'total_harga' => 125000,
        'status_pesanan' => 'menunggu_pembayaran',
    ]);

    $transaksi = Transaksi::create([
        'id_pesanan' => $pesanan->id_pesanan,
        'metode_pembayaran' => 'bca',
        'status_pembayaran' => 'menunggu',
    ]);

    $response = $this->actingAs($admin)
        ->patch(route('admin.payments.updateStatus', $transaksi->id_transaksi), [
            'status_pembayaran' => 'berhasil',
            'catatan_admin' => 'Bukti transfer telah diverifikasi.',
        ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('transaksi', [
        'id_transaksi' => $transaksi->id_transaksi,
        'status_pembayaran' => 'berhasil',
        'catatan_admin' => 'Bukti transfer telah diverifikasi.',
    ]);
    $this->assertDatabaseHas('pesanan', [
        'id_pesanan' => $pesanan->id_pesanan,
        'status_pesanan' => 'diproses',
    ]);
});

test('legacy admin transaction page redirects to payments', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get('/admin/transaksi');

    $response->assertRedirect('/admin/pembayaran');
});
