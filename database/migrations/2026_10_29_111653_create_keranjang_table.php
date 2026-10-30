<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->foreignId('id_user')->constrained('user', 'id_user')->cascadeOnDelete();
            $table->foreignId('id_produk')->constrained('produk', 'id_produk')->cascadeOnDelete();
            $table->unsignedBigInteger('jumlah')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
