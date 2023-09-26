<?php

namespace Database\Seeders;

use App\Models\TampungBayar;
use Illuminate\Database\Seeder;

class TampungBayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TampungBayar::factory()
            ->count(5)
            ->create();
    }
}
