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
        Schema::create('produk_custom_dijuals', function (Blueprint $table) {
            $table->id();
            $table->integer("id_toko");
            $table->string('nama_template');
            $table->string('kode');
            $table->string('status');
            $table->string('nama_produk')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->integer('panjang_max')->nullable();
            $table->integer('panjang_min')->nullable();
            $table->integer('tinggi_min')->nullable();
            $table->integer('tinggi_max')->nullable();
            $table->integer('lebar_max')->nullable();
            $table->integer('lebar_min')->nullable();
            $table->integer('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_custom_dijuals');
    }
};
