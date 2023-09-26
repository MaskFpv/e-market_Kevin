<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailPurchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPurchase::class;

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
            'purchase_id' => \App\Models\Purchase::factory(),
            'item_id' => \App\Models\Item::factory(),
        ];
    }
}
