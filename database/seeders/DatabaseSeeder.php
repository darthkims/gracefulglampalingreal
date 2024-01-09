<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);

        // create admin user
        $admin = User::factory()->create([
           'name' => 'Admin',
           'username' => 'admin',
           'email' => 'admin@material.com',
           'password' => ('secret')
        ]);
        $admin->assignRole('admin');

        //  $this->call(BrandSeeder::class);
        //  $this->call(CategorySeeder::class);
        //  $this->call(ColorSeeder::class);
        //  $this->call(ProductCategorySeeder::class);
        //  $this->call(ProductSeeder::class);
        //  $this->call(SizeSeeder::class);
        
    }
}
