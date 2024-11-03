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
        Schema::create('mutasi_barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->integer('id_mebel')->nullable();
            $table->integer('id_bahan')->nullable();
            $table->string('nama_barang');
            $table->integer('stok_masuk')->nullable();
            $table->integer('stok_keluar')->nullable();
            $table->string('jenis_mutasi');
            $table->string('jenis_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_barangs');
    }
};
