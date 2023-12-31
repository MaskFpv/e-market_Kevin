<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_pelanggan' => $this->faker->text(255),
            'nama' => $this->faker->text(255),
            'alamat' => $this->faker->text(255),
            'no_telp' => $this->faker->text(255),
            'email' => $this->faker->email,
        ];
    }
}
