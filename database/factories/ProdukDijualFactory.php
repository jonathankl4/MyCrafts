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
            'bahan' => $this->faker->word, // Tipe produk acak
            'harga_produk' => $this->faker->numberBetween(10000, 100000), // Harga antara 10k-100k
            'jumlah_produk' => $this->faker->numberBetween(1, 100), // Stok produk antara 1-100
            'ukuran' => $this->faker->numberBetween(10, 100), // Ukuran panjang acak
            'foto_produk1' => 'default-image.jpg', // Gambar produk default
            'foto_produk2' => 'default-image.jpg', // Gambar produk default
            'foto_produk3' => 'default-image.jpg', // Gambar produk default
            'foto_produk4' => 'default-image.jpg', // Gambar produk default
            'status' => 'nonaktif', // Status acak
        ];
    }
}
