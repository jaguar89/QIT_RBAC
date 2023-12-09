<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Laptops'],
            ['name' => 'Smartphones' ],
            ['name' => 'Desktops' ],
            ['name' => 'Wash machines' ],
            ['name' => 'Refrigerators' ],
        ];

       $parent = Category::create(['name' => 'Electrical Devices']);

        foreach ($categories as $category){
            $category['parent_id'] = $parent->id;
            Category::create($category);
        }


    }
}
