<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodcolor_seed = [
            ['product_id' => 1, 'color_id' => 1],
            ['product_id' => 2, 'color_id' => 11],
            ['product_id' => 3, 'color_id' => 5],
            ['product_id' => 4, 'color_id' => 2],
            ['product_id' => 5, 'color_id' => 2],
            ['product_id' => 6, 'color_id' => 2],
            ['product_id' => 7, 'color_id' => 2],
            ['product_id' => 8, 'color_id' => 7],
            ['product_id' => 9, 'color_id' => 2],
            ['product_id' => 10, 'color_id' => 2],
            ['product_id' => 11, 'color_id' => 10],
            ['product_id' => 12, 'color_id' => 3],
            ['product_id' => 13, 'color_id' => 8],
            ['product_id' => 13, 'color_id' => 2],
            ['product_id' => 14, 'color_id' => 10],
            ['product_id' => 15, 'color_id' => 2],
        ];
        

        foreach ($prodcolor_seed as $data) {
            DB::table('product_color')->insert($data);
        }
    }
}
