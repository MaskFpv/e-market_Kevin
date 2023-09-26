<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTransaction;

class DetailTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailTransaction::factory()
            ->count(5)
            ->create();
    }
}
