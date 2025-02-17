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
        Schema::create('penerimaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->dateTime('tanggal_penerimaan');
            $table->integer('jenis_penerimaan');
            $table->string('status_penerimaan')->nullable();
            $table->longText('catatan')->nullable();
            $table->timestamps();
        });
    }

    // jenis penerimaan
    // 1. retur
    // 2. hasil produksi 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_barangs');
    }
};
