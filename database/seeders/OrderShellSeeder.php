<?php

namespace Database\Seeders;

use App\Models\OrderShell;
use Illuminate\Database\Seeder;

class OrderShellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderShell::factory()
            ->count(5)
            ->create();
    }
}
