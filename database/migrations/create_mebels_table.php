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
        Schema::create('mebels', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->string('nama_mebel');
            $table->integer('harga_mebel');
            $table->integer('jumlah_mebel');
            $table->string('ukuran')->nullable();
            $table->string('bahan')->nullable();
            $table->string('keterangan_mebel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mebels');
    }
};
