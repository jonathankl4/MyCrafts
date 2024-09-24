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
        Schema::create('detail_addon_dijuals', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produk_custom_dijual');
            $table->string('nama_addon');
            $table->integer('harga');
            $table->string('jenis');
            $table->string('tipe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_addon_dijuals');
    }
};
