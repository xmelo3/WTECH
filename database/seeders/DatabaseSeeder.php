<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

public function run(): void
    {
        // 1. seed products FIRST
        $this->call(ProductSeeder::class);
        $this->call(AdminSeeder::class);

        // 2. create categories
        $cats = [
            'Animals'  => Category::firstOrCreate(['slug' => 'animals'],  ['name' => 'Animals']),
            'Vehicles' => Category::firstOrCreate(['slug' => 'vehicles'], ['name' => 'Vehicles']),
            'Food'     => Category::firstOrCreate(['slug' => 'food'],     ['name' => 'Food']),
            'Fantasy'  => Category::firstOrCreate(['slug' => 'fantasy'],  ['name' => 'Fantasy']),
            'Misc'     => Category::firstOrCreate(['slug' => 'misc'],     ['name' => 'Misc']),
        ];

        // 3. assign categories to products
        $map = [
            'Animals'       => 'Animals',
            'Deer'          => 'Animals',
            'Fighter Jet'   => 'Vehicles',
            'Army'          => 'Misc',
            'Charizard'     => 'Fantasy',
            'Border Collie' => 'Animals',
            'Catan Wheat'   => 'Misc',
            'These Nuts'    => 'Misc',
            'Banana'        => 'Food',
            'Citrus'        => 'Food',
            'Broccoli Head' => 'Food',
            'Chihuahua'     => 'Animals',
            'Go Eat Him'    => 'Food',
            'Dragon'        => 'Fantasy',
            'Surikata'      => 'Animals',
            'Doge Coin'     => 'Misc',
            'Fancy Dog'     => 'Animals',
            'Linus'         => 'Misc',
            'Guard Dog'     => 'Animals',
            'Skull'         => 'Fantasy',
        ];

        foreach ($map as $productName => $catName) {
            Product::where('name', 'LIKE', "%{$productName}%")
                    ->update(['category_id' => $cats[$catName]->id]);
        }
        Product::whereNull('category_id')->update(['category_id' => $cats['Misc']->id]);

        // 4. test user (remove duplicate forEach block from bottom)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}