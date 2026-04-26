<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name'        => fake()->words(2, true),
            'price'       => fake()->numberBetween(5000, 500000),
            'stock'       => fake()->numberBetween(1, 100),
            'description' => fake()->paragraph(),
            'unit'        => fake()->randomElement(['pcs', 'kg', 'liter', 'box', 'lusin']),
        ];
    }
}
