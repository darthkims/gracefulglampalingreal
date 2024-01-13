<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodbrad_seed = [
            ['product_id' => 1, 'brand_id' => 1],
            ['product_id' => 2, 'brand_id' => 1],
            ['product_id' => 3, 'brand_id' => 2],
            ['product_id' => 4, 'brand_id' => 1],
            ['product_id' => 5, 'brand_id' => 3],
            ['product_id' => 6, 'brand_id' => 3],
            ['product_id' => 7, 'brand_id' => 4],
            ['product_id' => 8, 'brand_id' => 5],
            ['product_id' => 9, 'brand_id' => 6],
            ['product_id' => 10, 'brand_id' => 7],
            ['product_id' => 11, 'brand_id' => 8],
            ['product_id' => 12, 'brand_id' => 9],
            ['product_id' => 13, 'brand_id' => 10],
            ['product_id' => 14, 'brand_id' => 11],
            ['product_id' => 15, 'brand_id' => 12],
            ['product_id' => 15, 'brand_id' => 13],

        ];
        

        foreach ($prodbrad_seed as $data) {
            DB::table('product_brand')->insert($data);
        }
    }
}
