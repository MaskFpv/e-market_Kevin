<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_pemasok' => $this->faker->text(255),
        ];
    }
}
