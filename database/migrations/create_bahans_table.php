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
        Schema::create('bahans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->string('nama_bahan');
            $table->string('ukuran_bahan')->nullable();
            $table->string('satuan_bahan')->nullable();
            $table->integer('jumlah_bahan')->nullable();
            $table->integer('harga_bahan')->nullable();
            $table->integer('ukuran_panjangBahan')->nullable();
            $table->integer('ukuran_lebarBahan')->nullable();
            $table->integer('ukuran_tinggiBahan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahans');
    }
};
