<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $detailmeja1 = [
            [
                'jenis_kayu'=> 'Kayu Jati',
                'harga'=> 1000
            ],
            [
                'jenis_kayu'=> 'Kayu Mahoni',
                'harga'=> 2000
            ],
            [
                'jenis_kayu'=> 'Kayu Pinus',
                'harga'=> 3000
            ],
            [
                'jenis_kayu'=> 'Kayu Sungkai',
                'harga'=> 4000
            ],
        ];

        DB::table('produk_customs')->insert([
            'nama_template' => 'Meja 1',
            'foto' => 'lemari1.png',
            'detail' => json_encode($detailmeja1)
        ]);

        
    }
}
