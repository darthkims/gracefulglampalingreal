<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $color_seed = [
            ['name' => 'White'],
            ['name' => 'Black'],
            ['name' => 'Blue'],
            ['name' => 'Red'],
            ['name' => 'Brown'],
            ['name' => 'Purple'],
            ['name' => 'Green'],
            ['name' => 'Yellow'],
            ['name' => 'Orange'],
            ['name' => 'Pink'],
            ['name' => 'Gray'],
            // Add more colors as needed
        ];

        // Insert data into the 'colors' table using Eloquent
        foreach ($color_seed as $color_data) {
            Color::create($color_data);
        }
    }
}
