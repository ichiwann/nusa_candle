<?php

test('shared login screen can be rendered', function () {
    $response = $this->get(route('login'));

    $response->assertOk()->assertSee('Masuk ke akun NusaCandle');
});

test('admin login URL redirects to the shared login URL', function () {
    $this->get(route('admin.login'))
        ->assertRedirect(route('login'));
});

test('guests are redirected away from the admin dashboard', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('login'));
});

test('admins can open the admin dashboard', function () {
    $admin = \App\Models\User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Selamat Datang, Admin')
        ->assertSee('Pengguna dengan Poin Tertinggi');
});

test('buyers cannot open the admin dashboard', function () {
    $buyer = \App\Models\User::factory()->create(['role' => 'pembeli']);

    $this->actingAs($buyer)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('admins can open gift management and settings', function () {
    $admin = \App\Models\User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('admin.gifts.index'))
        ->assertOk()
        ->assertSee('Kelola Hadiah');

    $this->actingAs($admin)
        ->get(route('admin.settings.edit'))
        ->assertOk()
        ->assertSee('Informasi Profil')
        ->assertSee('Ubah Password');
});

test('guests cannot open gift management or admin settings', function () {
    $this->get(route('admin.gifts.index'))->assertRedirect(route('login'));
    $this->get(route('admin.settings.edit'))->assertRedirect(route('login'));
});