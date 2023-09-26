<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransactionType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_jenis_pembayaran' => $this->faker->text(255),
        ];
    }
}
