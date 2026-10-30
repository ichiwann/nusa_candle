<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_user')->constrained('user', 'id_user')->cascadeOnDelete();
            $table->unsignedBigInteger('total_harga');
            $table->enum('status_pesanan', [
                'menunggu_pembayaran', 'diproses', 'dikirim', 'selesai', 'dibatalkan'
            ])->default('menunggu_pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
