<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat 5 Kategori, dan setiap kategori langsung dibuatkan 4 Produk berelasi
        Category::factory(5)->create()->each(function ($category) {
            Product::factory(10)->create([
                'category_id' => $category->id
            ]);
        });
    }
}
