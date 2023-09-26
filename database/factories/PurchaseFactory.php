<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_masuk' => $this->faker->text(255),
            'tanggal_masuk' => $this->faker->date,
            'total' => $this->faker->randomNumber(2),
            'supplier_id' => \App\Models\Supplier::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
