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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->integer('h_trans_id')->nullable();
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->double('amount')->default(0);
            $table->text('note')->nullable();
            $table->string('status')->default('pending');
            $table->string('snap_token')->nullable();
            $table->string('pilihan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
