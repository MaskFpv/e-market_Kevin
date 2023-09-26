<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailTransaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailTransaksi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jumlah_bayar' => $this->faker->randomNumber(2),
            'transaction_type_id' => \App\Models\TransactionType::factory(),
            'transaksi_id' => \App\Models\Transaksi::factory(),
        ];
    }
}
