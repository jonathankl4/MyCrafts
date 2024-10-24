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
        Schema::create('h_trans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_toko');
            $table->integer('id_user');
            $table->integer('id_produk');
            $table->string('nama_produk');
            $table->integer('jumlah');

            $table->string('tipe_trans');
            $table->integer('perkiraan_harga')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('harga_redesain')->nullable();
            $table->integer('panjang')->nullable();
            $table->integer('tinggi')->nullable();
            $table->string('jenis_kayu')->nullable();
            $table->integer('harga_kayu')->nullable();

            $table->string('fotoh1')->nullable();
            $table->string('fotoh2')->nullable();
            $table->string('fotoredesain')->nullable();
            $table->integer('status_redesain')->nullable();
            $table->integer('status')->nullable();
            $table->integer('status_pembayaran')->default(0);
            $table->dateTime('tgl_transaksi');
            $table->longText('catatan')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('nomorTelepon')->nullable();
            $table->string('pilihan')->nullable();
            $table->timestamps();
        });
    }

    // keterangan atribute status
    // status 0 = inisiate transaksi custom
    // status 1 = transkasi custom sudah submit (dalam review seller)
    // status 2 = seller mengajukan perbaikan desain
    // status 3 = pembelian sudah fix tinggal pembayaran
    // status 4 = sudah melakukan pembayaran, dalam proses produksi
    // status 5 = sudah melakukan pembayaran, siap dikirim, sudah selesai produksi(jika custom)
    // status 6 = dalam pengiriman
    // stasus 7 = Pesanan selesai
    // stasus 8 = Pesanan dibatalkan seller
    // stasus 9 = Pesanan dibatalkan buyer
    // stasus 10 = pembayaran dibatalkan
    // status 11 = belum di konfirmasi penjual (non custom)

    // keterangan atribute status pembayaran
    // status 0 = belom bayar
    // status 1 = sudah bayar

    // keterangan atribute status_redesain
    // status 1 = diajukan oleh seller
    // sttaus 2 = customer pilih desain milik sendiri
    // status 3 = cusdtomer pilih desain baru dari penjual

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_trans');
    }
};
