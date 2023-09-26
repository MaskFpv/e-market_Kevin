<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(BarangSeeder::class);
        $this->call(DetailPembelianSeeder::class);
        $this->call(DetailPenjualanSeeder::class);
        $this->call(DetailTransaksiSeeder::class);
        $this->call(PelangganSeeder::class);
        $this->call(PemasokSeeder::class);
        $this->call(PembelianSeeder::class);
        $this->call(PenjualanSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(RombelSeeder::class);
        $this->call(TampungBayarSeeder::class);
        $this->call(TransactionTypeSeeder::class);
        $this->call(TransaksiSeeder::class);
        $this->call(UserSeeder::class);
    }
}
