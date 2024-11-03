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
        Schema::create('toko', function (Blueprint $table) {
            $table->id();
            $table->integer("id_owner");
            $table->string("nama");
            $table->string("slogan")->nullable();
            $table->string("deskripsi")->nullable();
            $table->string("foto")->nullable();
            $table->string('status')->nullable();
            $table->integer('saldo')->default(0);
            $table->integer('saldo_pending')->default(0);
            $table->date('membership_expires_at')->nullable();
            $table->enum('membership_type', ['free', '1-month', '6-months', '12-months'])->default('free');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
