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
        Schema::create('penerimaan_bahans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->dateTime('tanggal_penerimaan');
            $table->integer('id_supplier');
            $table->string('status_penerimaan')->nullable();
            $table->longText('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_bahans');
    }
};
