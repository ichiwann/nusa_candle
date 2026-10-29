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
            $table->unsignedBigInteger('total_poin')->default(0);
            $table->timestamp('dibuat_pada')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};