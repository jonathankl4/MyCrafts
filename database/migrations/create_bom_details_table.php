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
        Schema::create('bom_details', function (Blueprint $table) {
            $table->id();
            $table->integer("id_bom");
            $table->string("nama_bahan");
            $table->string("deskripsi")->nullable();
            $table->string("jumlah")->nullable();
            $table->string("ukuran")->nullable();
            $table->integer("subtotal")->nullable();
            $table->string("harga")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bom_details');
    }
};
