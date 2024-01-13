<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodsize_seed = [
            ['product_id' => 1, 'size_id' => 9],
            ['product_id' => 2, 'size_id' => 14],
            ['product_id' => 3, 'size_id' => 14],
            ['product_id' => 4, 'size_id' => 10],
            ['product_id' => 5, 'size_id' => 2],
            ['product_id' => 6, 'size_id' => 2],
            ['product_id' => 7, 'size_id' => 2],
            ['product_id' => 8, 'size_id' => 14],
            ['product_id' => 9, 'size_id' => 14],
            ['product_id' => 10, 'size_id' => 14],
            ['product_id' => 11, 'size_id' => 3],
            ['product_id' => 12, 'size_id' => 10],
            ['product_id' => 13, 'size_id' => 14],
            ['product_id' => 14, 'size_id' => 14],
            ['product_id' => 15, 'size_id' => 14],
        ];
        

        foreach ($prodsize_seed as $data) {
            DB::table('product_size')->insert($data);
        }
    }
}
