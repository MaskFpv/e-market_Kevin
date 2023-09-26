<?php

namespace Database\Seeders;

use App\Models\Pemasok;
use Illuminate\Database\Seeder;

class PemasokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pemasok::factory()
            ->count(5)
            ->create();
    }
}
