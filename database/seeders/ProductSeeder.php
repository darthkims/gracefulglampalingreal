<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Import the Product model

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_seed = [
            ['product_name' => 'T-shirt', 'product_desc' => 'TEST', 'price' => '11.11'],
            ['product_name' => 'Jeans', 'product_desc' => 'TEST', 'price' => '14.11'],
            ['product_name' => 'Jacket', 'product_desc' => 'TEST', 'price' => '15.11'],
            ['product_name' => 'Pants', 'product_desc' => 'TEST', 'price' => '18.11'],
            ['product_name' => 'Tie', 'product_desc' => 'TEST', 'price' => '18.11'],
            ['product_name' => 'Watch', 'product_desc' => 'TEST', 'price' => '17.11'],
            ['product_name' => 'Spender', 'product_desc' => 'TEST', 'price' => '14.11'],
        ];

        // Insert data into the 'products' table using Eloquent
        foreach ($product_seed as $product_data) {
            Product::create($product_data);
        }
    }
}
