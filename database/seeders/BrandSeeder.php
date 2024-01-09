<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand_seed = [
            ['name' => 'Nike'],
            ['name' => 'New Era'],
            ['name' => 'H&M'],
            ['name' => 'Versace'],
            ['name' => 'Louis Vuitton (LV)'],
            ['name' => 'Estée Lauder'],
            ['name' => 'Armani'],
            ['name' => 'Bonia'],
            ['name' => 'Levi\'s'],
            ['name' => 'Christy Ng'],
            ['name' => 'Charles & Keith'],
            ['name' => 'Funko'],
            ['name' => 'Star Wars'],
            // Add more brands as needed
        ];
        
        // Insert data into the 'brands' table using Eloquent
        foreach ($brand_seed as $brand_data) {
            Brand::create($brand_data);
        }
    }
}
