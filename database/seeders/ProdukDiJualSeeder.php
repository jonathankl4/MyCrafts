<?php

namespace Database\Seeders;

use App\Models\ProdukDijual;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukDiJualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProdukDijual::factory()->count(10)->create();
    }
}
