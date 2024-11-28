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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->integer('id_mebel');
            $table->string('nama_penerima');
            $table->integer('jumlah');
            $table->dateTime('tanggal_pengiriman');
            $table->string('alamat');
            $table->string('jasa_pengiriman')->nullable();
            $table->string('nomor_resi')->nullable();
            $table->integer('biaya_pengiriman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
