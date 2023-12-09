<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(\Faker\Generator::class);

        $laptopCategory = Category::where('name', 'Laptops')->first();
        $smartphoneCategory = Category::where('name', 'Smartphones')->first();
        $washmachinesCategory = Category::where('name', 'Wash machines')->first();

        $this->createProductsForCategory($laptopCategory, 5, $faker);
        $this->createProductsForCategory($smartphoneCategory, 5, $faker);
        $this->createProductsForCategory($washmachinesCategory, 2, $faker);

    }

    private function createProductsForCategory($category, $numberOfProducts, $faker)
    {
        for ($i = 1; $i <= $numberOfProducts; $i++) {
            Product::create([
                'name' => $faker->words(3, true),
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 100, 1000),
                'category_id' => $category->id,
            ]);
        }
    }
}
