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
        Schema::create('penggunaan_bahans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produksi');
            $table->integer('id_bahan');
            $table->string('nama_bahan');
            $table->integer('jumlah_penggunaan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_bahans');
    }
};
