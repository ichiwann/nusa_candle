<?php

use App\Models\User;

test('admin dashboard uses the shared header and active sidebar style', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response
        ->assertOk()
        ->assertViewIs('pages.admin.dashboard')
        ->assertSee('Admin Ledger')
        ->assertSee('Console')
        ->assertSee('Buka ringkasan aktivitas')
        ->assertSee('Aktivitas 7 minggu terakhir')
        ->assertSee('border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]')
        ->assertDontSee('dashboard-topbar');
});
