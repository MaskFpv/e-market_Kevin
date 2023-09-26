<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTransaksi;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailTransaksi::factory()
            ->count(5)
            ->create();
    }
}
