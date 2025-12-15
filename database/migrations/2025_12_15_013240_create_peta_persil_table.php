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
        Schema::create('peta_persil', function (Blueprint $table) {
            $table->id('peta_id');
            $table->foreignId('persil_id')
                ->constrained('persil', 'persil_id')
                ->cascadeOnDelete();

            $table->json('geojson')->nullable();
            $table->decimal('panjang_m', 10, 2)->nullable();
            $table->decimal('lebar_m', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peta_persil');
    }
};
