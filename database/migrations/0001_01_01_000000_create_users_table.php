<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_lengkap', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->text('alamat');
            $table->string('password', 255);
            $table->enum('role', ['admin', 'pembeli'])->default('pembeli');
            $table->unsignedBigInteger('total_poin')->nullable()->default(null);
            $table->timestamps(); // created_at & updated_at
        });

        // Tabel password_reset_tokens (dari Breeze)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel sessions (dari Breeze)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
