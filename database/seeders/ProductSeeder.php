<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'test@test.com'],
            [
                'name' => 'Janko Hraško',
                'password' => bcrypt('password'),
            ]
        );

        $products = [
            ['name' => 'Animals',       'price' => 12.00, 'filament' => 'PLA',      'pieces' => 24, 'image' => 'products/st1.webp'],
            ['name' => 'Deer',          'price' => 18.00, 'filament' => 'PETG',     'pieces' => 36, 'image' => 'products/st2.webp'],
            ['name' => 'Fighter Jet',   'price' => 9.00,  'filament' => 'PLA',      'pieces' => 48, 'image' => 'products/st3.webp'],
            ['name' => 'Army',          'price' => 22.00, 'filament' => 'PLA/PETG', 'pieces' => 30, 'image' => 'products/st4.webp'],
            ['name' => 'Charizard',     'price' => 15.00, 'filament' => 'PLA',      'pieces' => 60, 'image' => 'products/st5.webp'],
            ['name' => 'Border Collie', 'price' => 30.00, 'filament' => 'PETG',     'pieces' => 32, 'image' => 'products/st6.webp'],
            ['name' => 'Catan Wheat',   'price' => 8.00,  'filament' => 'PLA',      'pieces' => 16, 'image' => 'products/st7.webp'],
            ['name' => 'These Nuts',    'price' => 11.00, 'filament' => 'PLA',      'pieces' => 20, 'image' => 'products/st8.webp'],
            ['name' => 'Banana',        'price' => 40.00, 'filament' => 'PLA',      'pieces' => 12, 'image' => 'products/st9.webp'],
            ['name' => 'Citrus',        'price' => 19.00, 'filament' => 'PETG',     'pieces' => 28, 'image' => 'products/st10.webp'],
            ['name' => 'Broccoli Head', 'price' => 13.00, 'filament' => 'PLA',      'pieces' => 18, 'image' => 'products/st11.webp'],
            ['name' => 'Chihuahua',     'price' => 21.00, 'filament' => 'PLA/PETG', 'pieces' => 40, 'image' => 'products/st12.webp'],
            ['name' => 'Go Eat Him',    'price' => 17.00, 'filament' => 'PLA',      'pieces' => 22, 'image' => 'products/st13.webp'],
            ['name' => 'Dragon',        'price' => 25.00, 'filament' => 'PETG',     'pieces' => 72, 'image' => 'products/st14.webp'],
            ['name' => 'Surikata',      'price' => 6.00,  'filament' => 'PLA',      'pieces' => 14, 'image' => 'products/st15.webp'],
            ['name' => 'Doge Coin',     'price' => 14.00, 'filament' => 'PLA',      'pieces' => 10, 'image' => 'products/st16.webp'],
            ['name' => 'Fancy Dog',     'price' => 32.00, 'filament' => 'PETG',     'pieces' => 44, 'image' => 'products/st17.webp'],
            ['name' => 'Linus',         'price' => 27.00, 'filament' => 'PLA',      'pieces' => 38, 'image' => 'products/st18.webp'],
            ['name' => 'Guard Dog',     'price' => 10.00, 'filament' => 'PLA/PETG', 'pieces' => 26, 'image' => 'products/st19.webp'],
            ['name' => 'Skull',         'price' => 45.00, 'filament' => 'PLA',      'pieces' => 18, 'image' => 'products/st20.webp'],
        ];

        foreach ($products as $data) {
            Product::create([
                'name'              => $data['name'],
                'price'             => $data['price'],
                'short_description' => 'A great 3D printable model.',
                'description'       => 'Detailed description of ' . $data['name'] . '. Includes STL and 3MF files.',
                'filament'          => $data['filament'],
                'pieces'            => $data['pieces'],
                'print_time'        => '~3 h',
                'supports'          => 'No',
                'infill'            => '15%',
                'layer_height'      => '0.2 mm',
                'file_format'       => 'STL, 3MF',
                'license'           => 'Personal use',
                'main_image'        => $data['image'],
                'rating_count'      => rand(10, 200),
                'rating_avg'        => round(rand(30, 50) / 10, 1),
                'user_id'           => $user->id,
            ]);
        }
    }
}