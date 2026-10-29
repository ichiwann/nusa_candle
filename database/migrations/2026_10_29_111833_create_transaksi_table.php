<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_pesanan')->constrained('pesanan', 'id_pesanan')->onDelete('cascade');
            $table->enum('metode_pembayaran', [
                'bca', 'mandiri', 'gopay', 'dana', 'shopeepay', 'cash'
            ]);
            $table->enum('status_pembayaran', [
                'menunggu', 'berhasil', 'gagal'
            ])->default('menunggu');
            $table->string('bukti_pembayaran', 255)->nullable();
            $table->timestamp('tanggal_transaksi')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
