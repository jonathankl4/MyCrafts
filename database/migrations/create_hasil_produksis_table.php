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
        Schema::create('hasil_produksis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->integer("id_bom");
            $table->string("nama_produk");
            $table->integer("jumlah_diproduksi");
            $table->integer("jumlah_berhasil");
            $table->integer("jumlah_gagal");
            $table->integer("durasi");
            $table->integer('id_produksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_produksis');
    }
};
