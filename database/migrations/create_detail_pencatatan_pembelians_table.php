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
        Schema::create('detail_pencatatan_pembelians', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pencatatan');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan')->nullable();
            $table->integer('harga');
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pencatatan_pembelians');
    }
};
