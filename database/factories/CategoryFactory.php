<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Elektronik', 'Pakaian pria', 'Makanan & Minuman', 'Peralatan Rumah', 'Kesehatan'];
        $name = $this->faker->unique()->words(2, true);
return [
    'name'        => ucfirst($name),
    'slug'        => Str::slug($name),
    'description' => $this->faker->sentence(10),
];
    }
}
