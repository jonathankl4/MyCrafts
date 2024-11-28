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
        // penerimaan bahan
        Schema::create('detail_penerimaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_penerimaan');
            $table->integer('id_barang');
            $table->integer('jumlah');
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penerimaan_barangs');
    }
};
