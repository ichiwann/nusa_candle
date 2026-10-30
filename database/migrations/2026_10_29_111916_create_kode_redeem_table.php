<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kode_redeem', function (Blueprint $table) {
            $table->id('id_kode');
            $table->foreignId('id_user')->constrained('user', 'id_user')->cascadeOnDelete();
            $table->string('kode', 32)->unique();
            $table->unsignedBigInteger('poin');
            $table->enum('status', ['tersedia', 'terpakai'])->default('tersedia');
            $table->dateTime('dipakai_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kode_redeem');
    }
};
