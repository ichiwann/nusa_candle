<?php

use App\Models\User;

test('admin settings page uses the ledger shell and separates profile and password forms', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('admin.settings.edit'));

    $response
        ->assertOk()
        ->assertViewIs('pages.admin.settings')
        ->assertSee('Admin Ledger')
        ->assertSee('Console')
        ->assertSee('Akun Admin')
        ->assertSee('Data Profil Admin')
        ->assertSee('Update Data Admin')
        ->assertSee('Update Password')
        ->assertSee('border-[#ae2527] bg-[#f7f4e9] text-[#153f2e]')
        ->assertDontSee('Administrator · Online');
});
