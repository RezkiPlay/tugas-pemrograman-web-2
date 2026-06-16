<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    Supplier::factory(5)->create();

    Category::factory(5)->create()->each(function ($category) {
        Product::factory(10)->create([
            'category_id' => $category->id,
            'supplier_id' => Supplier::inRandomOrder()->first()->id,
        ]);
    });
}
}
