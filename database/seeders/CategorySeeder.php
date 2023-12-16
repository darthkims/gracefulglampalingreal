<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_seed = [
            ['category_name' => 'Collectibles'],
            ['category_name' => 'Pants'],
            ['category_name' => 'Cosmetics'],
            ['category_name' => 'Shoes'],
            ['category_name' => 'Accessories'],
            ['category_name' => 'Shirts'],
            ['category_name' => 'Men'],
            ['category_name' => 'Women'],
            ['category_name' => 'Unisex'],
            // Add more categories as needed
        ];

        // Insert data into the 'categories' table using Eloquent
        foreach ($category_seed as $category_data) {
            Category::create($category_data);
        }
    }
}
