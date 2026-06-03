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
            // Memanggil langsung path absolut Model Category agar tidak nyasar ke folder factory
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? \App\Models\Category::factory(),
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->numberBetween(10000, 500000),
            'stock' => $this->faker->numberBetween(5, 100),
            'description' => $this->faker->paragraph(),
            'unit' => $this->faker->randomElement(['pcs', 'pack', 'kg', 'liter']),
        ];
    }
}
