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
        Schema::create('sengketa_persil', function (Blueprint $table) {
            $table->id('sengketa_id');
            $table->foreignId('persil_id')
                ->constrained('persil', 'persil_id')
                ->cascadeOnDelete();

            $table->string('pihak_1');
            $table->string('pihak_2');
            $table->text('kronologi');
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->text('penyelesaian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sengketa_persil');
    }
};
