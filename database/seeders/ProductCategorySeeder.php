<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodcrat_seed = [
            ['product_id' => 1, 'category_id' => 4],
            ['product_id' => 2, 'category_id' => 5],
            ['product_id' => 3, 'category_id' => 5],
            ['product_id' => 4, 'category_id' => 4],
            ['product_id' => 5, 'category_id' => 6],
            ['product_id' => 6, 'category_id' => 6],
            ['product_id' => 7, 'category_id' => 2],
            ['product_id' => 8, 'category_id' => 5],
            ['product_id' => 9, 'category_id' => 3],
            ['product_id' => 10, 'category_id' => 3],
            ['product_id' => 11, 'category_id' => 6],
            ['product_id' => 12, 'category_id' => 2],
            ['product_id' => 13, 'category_id' => 5],
            ['product_id' => 14, 'category_id' => 5],
            ['product_id' => 15, 'category_id' => 1],

        ];
        

        foreach ($prodcrat_seed as $data) {
            DB::table('product_category')->insert($data);
        }
    }
}
