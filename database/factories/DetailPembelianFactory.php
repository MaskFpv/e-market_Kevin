<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailPembelian;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPembelianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPembelian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'harga_beli' => $this->faker->randomNumber(2),
            'jumlah' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(2),
            'barang_id' => \App\Models\Barang::factory(),
            'pembelian_id' => \App\Models\Pembelian::factory(),
        ];
    }
}
