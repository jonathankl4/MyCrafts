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
        Schema::create('produk_dijuals', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->string('nama_produk');
            $table->string('tipe_produk')->nullable();
            $table->integer('harga_produk');
            $table->integer('jumlah_produk');
            $table->integer('ukuran_panjangproduk')->nullable();
            $table->integer('ukuran_lebarproduk')->nullable();
            $table->integer('ukuran_tinggiproduk')->nullable();
            $table->string('satuanUkuran_produk')->nullable();
            $table->string('keterangan_produk')->nullable();
            $table->integer('berat_produk')->nullable();
            $table->string('foto_produk1')->nullable();
            $table->string('foto_produk2')->nullable();
            $table->string('foto_produk3')->nullable();
            $table->string('foto_produk4')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_dijuals');
    }
};
