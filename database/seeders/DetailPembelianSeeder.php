<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPembelian;

class DetailPembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailPembelian::factory()
            ->count(5)
            ->create();
    }
}
