<?php

namespace Database\Factories;

use App\Models\OrderShell;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderShellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderShell::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomNumber(2),
            'terima' => $this->faker->randomNumber(2),
            'kembali' => $this->faker->randomNumber(2),
            'order_id' => \App\Models\Order::factory(),
        ];
    }
}
