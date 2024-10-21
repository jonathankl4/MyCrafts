<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProdukDijual>
 */
class ProdukDijualFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_toko' => $this->faker->numberBetween(1, 2), // ID toko acak dari 1 hingga 50
            'nama_produk' => $this->faker->word, // Nama produk acak
            'tipe_produk' => $this->faker->word, // Tipe produk acak
            'harga_produk' => $this->faker->numberBetween(10000, 100000), // Harga antara 10k-100k
            'jumlah_produk' => $this->faker->numberBetween(1, 100), // Stok produk antara 1-100
            'ukuran_panjangproduk' => $this->faker->numberBetween(10, 100), // Ukuran panjang acak
            'ukuran_lebarproduk' => $this->faker->numberBetween(10, 100), // Ukuran lebar acak
            'ukuran_tinggiproduk' => $this->faker->numberBetween(10, 100), // Ukuran tinggi acak
            'satuanUkuran_produk' => $this->faker->randomElement(['cm', 'm', 'inch']), // Satuan ukuran acak
            'keterangan_produk' => $this->faker->sentence, // Keterangan produk acak
            'berat_produk' => $this->faker->numberBetween(100, 10000), // Berat acak dalam gram
            'foto_produk1' => 'default-image.jpg', // Gambar produk default
            'foto_produk2' => 'default-image.jpg', // Gambar produk default
            'foto_produk3' => 'default-image.jpg', // Gambar produk default
            'foto_produk4' => 'default-image.jpg', // Gambar produk default

            'status' => 'aktif', // Status acak
        ];
    }
}
