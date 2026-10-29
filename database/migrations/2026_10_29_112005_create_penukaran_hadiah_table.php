<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penukaran_hadiah', function (Blueprint $table) {
            $table->id('id_penukaran');
            $table->foreignId('id_user')->constrained('user', 'id_user')->onDelete('cascade');
            $table->foreignId('id_hadiah')->constrained('hadiah', 'id_hadiah')->onDelete('cascade');
            $table->unsignedBigInteger('poin_ditukar');
            $table->enum('status_klaim', [
                'pending', 'disetujui', 'ditolak'
            ])->default('pending');
            $table->string('catatan', 255)->nullable();
            $table->timestamp('tanggal_klaim')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penukaran_hadiah');
    }
};
