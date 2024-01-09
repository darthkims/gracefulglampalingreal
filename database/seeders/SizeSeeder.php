<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $size_seed = [
            ['name' => 'XS'],
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
            ['name' => 'XS'],
            ['name' => '32'],
            ['name' => '31'],
            ['name' => '33'],
            ['name' => '34'],
            ['name' => '28'],
            ['name' => '29'],
            ['name' => '30'],
            ['name' => 'One Size'],
        ];

        // Insert data into the 'sizes' table using Eloquent
        foreach ($size_seed as $size_data) {
            Size::create($size_data);
        }
    }
}
