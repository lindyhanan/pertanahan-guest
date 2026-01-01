<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persil', function (Blueprint $table) {
    $table->id('persil_id');
    $table->string('kode_persil')->unique();

    // FK ke warga
    $table->unsignedBigInteger('pemilik_warga_id');

    // 🔥 FIX DI SINI
    $table->unsignedInteger('penggunaan_id');

    $table->decimal('luas_m2', 10, 2);
    $table->string('alamat_lahan');
    $table->string('rt', 5);
    $table->string('rw', 5);
    $table->timestamps();

    // FK warga
    $table->foreign('pemilik_warga_id')
        ->references('warga_id')
        ->on('warga')
        ->cascadeOnDelete();

    // FK penggunaan (INT ↔ INT)
    $table->foreign('penggunaan_id')
        ->references('jenis_id')
        ->on('penggunaan')
        ->cascadeOnDelete();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persil');
    }
};
