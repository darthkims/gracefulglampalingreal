<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
           'name' => 'Admin',
           'username' => 'admin',
           'email' => 'admin@material.com',
           'password' => ('secret')
        ]);

        // $this->call(ProductSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(ProductCategorySeeder::class);
        
    }
}
