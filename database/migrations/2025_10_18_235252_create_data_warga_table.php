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
        Schema::create('data_warga', function (Blueprint $table) {
            $table->increments('warga_id');
            $table->string('no_ktp', 16)->unique();
            $table->string('nama', 50);
            $table->string('jenis_kelamin', 50);
            $table->string('agama', 50);
            $table->string('pekerjaan', 50);
            $table->string('telp', 50);
            $table->string('email', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_warga');
    }
};
