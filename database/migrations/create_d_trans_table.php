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
        Schema::create('d_trans', function (Blueprint $table) {
            $table->id();
            $table->integer('h_trans_id');  // Foreign key ke header transaksi
            $table->string('nama_item');  // Nama add-on atau pintu
            $table->integer('jumlah');
            $table->integer('harga');
            $table->string('jenis'); // jenis add on main atau second
            $table->string('cek_redesain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_trans');
    }
};
