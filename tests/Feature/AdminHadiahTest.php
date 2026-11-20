<?php

use App\Models\Hadiah;
use App\Models\PenukaranHadiah;
use App\Models\Produk;
use App\Models\User;

test('admin rewards page renders sample customers without saving them', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('admin.hadiah.index'));

    $response
        ->assertOk()
        ->assertSee('Maya Anggraini')
        ->assertSee('Rian Kusuma')
        ->assertSee('Dewi Lestari')
        ->assertSee('Bagus Satrio')
        ->assertSee('Fajar Nugraha')
        ->assertSee('Refill Lilin Aromaterapi Aroma Apel')
        ->assertSee('70 Poin')
        ->assertSee('64%')
        ->assertSee('Klaim Dilakukan')
        ->assertSee('Memenuhi Syarat')
        ->assertSee('Selesai Diklaim')
        ->assertSee('Belum Memenuhi Syarat')
        ->assertSee('Konfirmasi Klaim')
        ->assertSee('Klaim Selesai')
        ->assertSee('Tambah Hadiah')
        ->assertSee('Belum ada produk yang tersedia')
        ->assertDontSee('Demo');
    $this->assertDatabaseCount('penukaran_hadiah', 0);
    $this->assertDatabaseCount('hadiah', 0);
    $this->assertDatabaseCount('produk', 0);
    $this->assertDatabaseCount('user', 1);
});

test('admin can add an available product as a reward', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $availableProduct = new Produk([
        'nama_produk' => 'Lilin Lavender',
        'stok' => 4,
        'harga' => 120000,
    ]);
    $availableProduct->id_produk = 1000001;
    $availableProduct->save();

    $existingRewardProduct = new Produk([
        'nama_produk' => 'Refill Apel',
        'stok' => 6,
        'harga' => 80000,
    ]);
    $existingRewardProduct->id_produk = 1000002;
    $existingRewardProduct->save();
    Hadiah::create([
        'id_produk' => $existingRewardProduct->id_produk,
        'poin_dibutuhkan' => 70,
    ]);

    $page = $this->actingAs($admin)->get(route('admin.hadiah.index'));

    $page
        ->assertOk()
        ->assertSee('Lilin Lavender')
        ->assertSee('value="1000001"', false)
        ->assertDontSee('value="1000002"', false);

    $response = $this->from(route('admin.hadiah.index'))
        ->post(route('admin.hadiah.store'), [
            'id_produk' => $availableProduct->id_produk,
            'poin_dibutuhkan' => 90,
        ]);

    $response
        ->assertRedirect(route('admin.hadiah.index'))
        ->assertSessionHas('success', 'Hadiah berhasil ditambahkan.');
    $this->assertDatabaseHas('hadiah', [
        'id_produk' => $availableProduct->id_produk,
        'poin_dibutuhkan' => 90,
    ]);
});

test('admin rewards page shows claim progress against the actual reward threshold', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create([
        'nama_lengkap' => 'Lina <script>alert("xss")</script>',
        'total_poin' => 15,
    ]);

    $product = new Produk([
        'nama_produk' => 'Lilin Melati',
        'stok' => 4,
        'harga' => 120000,
    ]);
    $product->id_produk = 1000001;
    $product->save();

    $reward = Hadiah::create([
        'id_produk' => $product->id_produk,
        'poin_dibutuhkan' => 125,
    ]);

    PenukaranHadiah::create([
        'id_user' => $user->id_user,
        'id_hadiah' => $reward->id_hadiah,
        'poin_ditukar' => 125,
        'poin_saat_klaim' => 100,
        'status_klaim' => 'pending',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.hadiah.index'));

    $response
        ->assertOk()
        ->assertSee('Kelola Hadiah & Poin Loyalitas')
        ->assertSee('Daftar Hadiah')
        ->assertSee('Data Poin Pengguna')
        ->assertSee('Lilin Melati')
        ->assertSee('100 / 125 Poin')
        ->assertSee('80%')
        ->assertSee('Klaim Dilakukan')
        ->assertSee($user->nama_lengkap)
        ->assertSee('\u003Cscript\u003E', false)
        ->assertDontSee('Lina <script>', false)
        ->assertDontSee('<script>alert("xss")</script>', false);
});
