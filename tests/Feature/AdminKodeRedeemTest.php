<?php

use App\Models\KodeRedeem;
use App\Models\User;

test('admin redeem page displays preview codes without saving them when none exist', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('admin.kodeRedeem.index'));

    $response
        ->assertOk()
        ->assertSee('Redeem Code Poin')
        ->assertSee('Buat Redeem Code')
        ->assertSee('REFILL-APEL-2024')
        ->assertSee('APEL-MALANG-GRATIS')
        ->assertSee('HARVEST-REFILL-APEL')
        ->assertSee('BOTANICAL-APEL-GIFT')
        ->assertSee('LOYALTY-REFILL-APEL')
        ->assertSee('REFILL-APEL-PROMO')
        ->assertSee('Dian Pratiwi')
        ->assertSee('Rian Kusuma')
        ->assertSee('Tersedia')
        ->assertSee('Kadaluarsa')
        ->assertSee('Admin Ledger')
        ->assertSee('Console')
        ->assertSee('border-l-[3px] border-[#ae2527] rounded-none bg-[#f7f4e9] text-[#153f2e]')
        ->assertDontSee('Administrator · Online')
        ->assertDontSee('Total Kode')
        ->assertDontSee('Cari kode atau nama pengguna');

    $this->assertDatabaseCount('kode_redeem', 0);
    $this->assertDatabaseCount('user', 1);
});

test('admin redeem page displays saved codes instead of preview codes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $redeemCode = KodeRedeem::create([
        'kode' => 'REAL-REDEEM-1',
        'poin' => 12,
        'status' => 'tersedia',
        'berlaku_hingga' => now()->addWeek()->toDateString(),
    ]);

    $response = $this->actingAs($admin)->get(route('admin.kodeRedeem.index'));

    $response
        ->assertOk()
        ->assertSee($redeemCode->kode)
        ->assertSee('12')
        ->assertDontSee('REFILL-APEL-2024');

    $this->assertDatabaseCount('kode_redeem', 1);
});
