<?php

namespace Database\Factories;

use App\Models\Penjualan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penjualan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_faktur' => $this->faker->text(255),
            'tgl_faktur' => $this->faker->date,
            'total_bayar' => $this->faker->randomNumber(2),
            'user_id' => \App\Models\User::factory(),
            'pelanggan_id' => \App\Models\Pelanggan::factory(),
        ];
    }
}
