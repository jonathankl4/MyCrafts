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
        Schema::create('returs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko')->nullable();
            $table->integer('jumlah');
            $table->string('alasan_retur');
            $table->dateTime('tgl_retur');
            $table->dateTime('tgl_retur_sampai')->nullable();
            $table->integer('status');
            $table->longText('alasan_retur_ditolak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returs');
    }
};
