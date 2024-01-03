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
            ['name' => 'Collectibles'],
            ['name' => 'Pants'],
            ['name' => 'Cosmetics'],
            ['name' => 'Shoes'],
            ['name' => 'Accessories'],
            ['name' => 'Shirts'],
            ['name' => 'Men'],
            ['name' => 'Women'],
            ['name' => 'Unisex'],
            // Add more categories as needed
        ];

        // Insert data into the 'categories' table using Eloquent
        foreach ($category_seed as $category_data) {
            Category::create($category_data);
        }
    }
}
