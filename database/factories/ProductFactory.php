<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->sentence(),
            'product_type' => $this->faker->word(),
            'product_brand' => $this->faker->word(),
            'product_price' => $this->faker->randomFloat(2, 0, 100),
            'product_ingredient' => $this->faker->sentence(),
            'product_stock' => $this->faker->numberBetween(0, 100),
            'creator_id' => User::factory(),
        ];
    }
}
