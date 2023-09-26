<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPenjualanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPenjualan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'harga_jual' => $this->faker->randomNumber(2),
            'jumlah' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(2),
            'barang_id' => \App\Models\Barang::factory(),
            'penjualan_id' => \App\Models\Penjualan::factory(),
        ];
    }
}
