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
            $table->string('tipe_mebel')->nullable();
            $table->integer('harga_mebel');
            $table->integer('jumlah_mebel');
            $table->integer('ukuran_panjangMebel')->nullable();
            $table->integer('ukuran_lebarMebel')->nullable();
            $table->integer('ukuran_tinggiMebel')->nullable();
            $table->string('satuanUkuran_mebel')->nullable();
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
