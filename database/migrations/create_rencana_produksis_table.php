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
        
        Schema::create('rencana_produksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produksi')->nullable();
            $table->integer("id_toko");
            $table->date("tgl_produksi_mulai");
            $table->date("tgl_produksi_selesai")->nullable();
            $table->integer('jumlahdiproduksi');
            $table->string('waktu_produksi')->nullable();
            $table->string('nama_produk')->nullable();
            $table->integer('id_bom')->nullable();
            $table->integer('status')->comment("0=belum start, 1= sudah start, 2= sudah selesai, 3=dibatalkan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_produksis');
    }
};
