<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jumlah_bayar' => $this->faker->randomNumber(2),
            'transaction_id' => \App\Models\Transaction::factory(),
            'transaction_type_id' => \App\Models\TransactionType::factory(),
        ];
    }
}
