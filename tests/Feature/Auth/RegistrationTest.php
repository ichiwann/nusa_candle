<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'nama_lengkap' => 'Test User',
        'username' => 'test-user',
        'email' => 'ada@gmail.com',
        'alamat' => 'Malang, Jawa Timur',
        'no_telepon' => '081234567890',
        'password' => 'password',
        'password_confirmation' => 'password',
        'terms' => '1',
    ]);

    $response->assertRedirect(route('login'))
        ->assertSessionHas('success');

    $this->assertGuest();
    $this->assertDatabaseHas('user', [
        'username' => 'test-user',
        'email' => 'ada@gmail.com',
        'role' => 'pembeli',
    ]);
});

test('users must accept the terms before registering', function () {
    $this->post('/register', [
        'nama_lengkap' => 'Test User',
        'username' => 'test-user-no-terms',
        'email' => 'no-terms@example.com',
        'alamat' => 'Malang, Jawa Timur',
        'no_telepon' => '081234567890',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertSessionHasErrors('terms');

    $this->assertDatabaseMissing('user', [
        'email' => 'no-terms@example.com',
    ]);
});

test('phone number must contain digits only', function () {
    $this->post('/register', [
        'nama_lengkap' => 'Test User',
        'username' => 'test-user-invalid-phone',
        'email' => 'invalid-phone@example.com',
        'alamat' => 'Malang, Jawa Timur',
        'no_telepon' => '0812ABC456',
        'password' => 'password',
        'password_confirmation' => 'password',
        'terms' => '1',
    ])->assertSessionHasErrors('no_telepon');

    $this->assertDatabaseMissing('user', [
        'email' => 'invalid-phone@example.com',
    ]);
});

test('password confirmation must match the password', function () {
    $this->post('/register', [
        'nama_lengkap' => 'Test User',
        'username' => 'test-user-password-mismatch',
        'email' => 'password-mismatch@example.com',
        'alamat' => 'Malang, Jawa Timur',
        'no_telepon' => '081234567890',
        'password' => 'password',
        'password_confirmation' => 'different-password',
        'terms' => '1',
    ])->assertSessionHasErrors('password_confirmation');

    $this->assertDatabaseMissing('user', [
        'email' => 'password-mismatch@example.com',
    ]);
});

test('registration rejects malformed field values', function (string $field, string $value, string $email) {
    $data = [
        'nama_lengkap' => 'Test User',
        'username' => 'test-user-invalid-data',
        'email' => $email,
        'alamat' => 'Malang, Jawa Timur',
        'no_telepon' => '081234567890',
        'password' => 'password',
        'password_confirmation' => 'password',
        'terms' => '1',
    ];
    $data[$field] = $value;

    $this->post('/register', $data)->assertSessionHasErrors($field);
})->with([
    'name cannot contain numbers' => ['nama_lengkap', 'Test User 1', 'invalid-name@example.com'],
    'username cannot contain spaces' => ['username', 'bad username', 'invalid-username@example.com'],
    'email must be valid' => ['email', 'not-an-email', 'invalid-email@example.com'],
    'address must be descriptive' => ['alamat', 'Short', 'invalid-address@example.com'],
]);
