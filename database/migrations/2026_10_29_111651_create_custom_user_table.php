<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('user')) {
            return;
        }

        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_lengkap', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->text('alamat');
            $table->string('no_telepon', 20)->nullable();
            $table->string('password', 255);
            $table->enum('role', ['admin', 'pembeli'])->default('pembeli');
            $table->unsignedBigInteger('total_poin')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};