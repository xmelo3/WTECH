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
                'name'     => 'Janko Hraško',
                'password' => bcrypt('password'),
            ]
        );

        $products = [
            // ── Original 20 ───────────────────────────────────────────────
            ['name' => 'Animals',        'price' => 12.00, 'filament' => 'PLA',      'pieces' => 24, 'image' => 'products/st1.webp',  'file_format' => 'STL',      'colour' => 'Natural'],
            ['name' => 'Deer',           'price' => 18.00, 'filament' => 'PETG',     'pieces' => 36, 'image' => 'products/st2.webp',  'file_format' => '3MF',      'colour' => 'Brown'],
            ['name' => 'Fighter Jet',    'price' => 9.00,  'filament' => 'PLA',      'pieces' => 48, 'image' => 'products/st3.webp',  'file_format' => 'STL',      'colour' => 'Grey'],
            ['name' => 'Army',           'price' => 22.00, 'filament' => 'PLA/PETG', 'pieces' => 30, 'image' => 'products/st4.webp',  'file_format' => 'STL, 3MF', 'colour' => 'Green'],
            ['name' => 'Charizard',      'price' => 15.00, 'filament' => 'PLA',      'pieces' => 60, 'image' => 'products/st5.webp',  'file_format' => 'STL',      'colour' => 'Orange'],
            ['name' => 'Border Collie',  'price' => 30.00, 'filament' => 'PETG',     'pieces' => 32, 'image' => 'products/st6.webp',  'file_format' => 'OBJ',      'colour' => 'Black'],
            ['name' => 'Catan Wheat',    'price' => 8.00,  'filament' => 'PLA',      'pieces' => 16, 'image' => 'products/st7.webp',  'file_format' => '3MF',      'colour' => 'Yellow'],
            ['name' => 'These Nuts',     'price' => 11.00, 'filament' => 'PLA',      'pieces' => 20, 'image' => 'products/st8.webp',  'file_format' => 'STL',      'colour' => 'Natural'],
            ['name' => 'Banana',         'price' => 40.00, 'filament' => 'PLA',      'pieces' => 12, 'image' => 'products/st9.webp',  'file_format' => 'OBJ',      'colour' => 'Yellow'],
            ['name' => 'Citrus',         'price' => 19.00, 'filament' => 'PETG',     'pieces' => 28, 'image' => 'products/st10.webp', 'file_format' => 'STL, 3MF', 'colour' => 'Orange'],
            ['name' => 'Broccoli Head',  'price' => 13.00, 'filament' => 'PLA',      'pieces' => 18, 'image' => 'products/st11.webp', 'file_format' => 'STL',      'colour' => 'Green'],
            ['name' => 'Chihuahua',      'price' => 21.00, 'filament' => 'PLA/PETG', 'pieces' => 40, 'image' => 'products/st12.webp', 'file_format' => '3MF',      'colour' => 'Brown'],
            ['name' => 'Go Eat Him',     'price' => 17.00, 'filament' => 'PLA',      'pieces' => 22, 'image' => 'products/st13.webp', 'file_format' => 'OBJ',      'colour' => 'Natural'],
            ['name' => 'Dragon',         'price' => 25.00, 'filament' => 'PETG',     'pieces' => 72, 'image' => 'products/st14.webp', 'file_format' => 'STL, 3MF', 'colour' => 'Red'],
            ['name' => 'Surikata',       'price' => 6.00,  'filament' => 'PLA',      'pieces' => 14, 'image' => 'products/st15.webp', 'file_format' => 'STL',      'colour' => 'Natural'],
            ['name' => 'Doge Coin',      'price' => 14.00, 'filament' => 'PLA',      'pieces' => 10, 'image' => 'products/st16.webp', 'file_format' => '3MF',      'colour' => 'Yellow'],
            ['name' => 'Fancy Dog',      'price' => 32.00, 'filament' => 'PETG',     'pieces' => 44, 'image' => 'products/st17.webp', 'file_format' => 'OBJ',      'colour' => 'White'],
            ['name' => 'Linus',          'price' => 27.00, 'filament' => 'PLA',      'pieces' => 38, 'image' => 'products/st18.webp', 'file_format' => 'STL',      'colour' => 'Black'],
            ['name' => 'Guard Dog',      'price' => 10.00, 'filament' => 'PLA/PETG', 'pieces' => 26, 'image' => 'products/st19.webp', 'file_format' => 'STL, 3MF', 'colour' => 'Grey'],
            ['name' => 'Skull',          'price' => 45.00, 'filament' => 'PLA',      'pieces' => 18, 'image' => 'products/st20.webp', 'file_format' => 'STL',      'colour' => 'White'],

            // ── Extra products (images reused) ────────────────────────────
            ['name' => 'Mini Animals',   'price' => 7.00,  'filament' => 'PLA',      'pieces' => 12, 'image' => 'products/st1.webp',  'file_format' => 'OBJ',      'colour' => 'White'],
            ['name' => 'Forest Deer',    'price' => 20.00, 'filament' => 'PETG',     'pieces' => 40, 'image' => 'products/st2.webp',  'file_format' => 'STL',      'colour' => 'White'],
            ['name' => 'Stealth Jet',    'price' => 14.00, 'filament' => 'PLA',      'pieces' => 52, 'image' => 'products/st3.webp',  'file_format' => '3MF',      'colour' => 'Blue'],
            ['name' => 'Army Elite',     'price' => 28.00, 'filament' => 'PLA/PETG', 'pieces' => 35, 'image' => 'products/st4.webp',  'file_format' => 'OBJ',      'colour' => 'Green'],
            ['name' => 'Shiny Charizard','price' => 19.00, 'filament' => 'PLA',      'pieces' => 60, 'image' => 'products/st5.webp',  'file_format' => 'STL, 3MF', 'colour' => 'Red'],
            ['name' => 'Puppy Pack',     'price' => 24.00, 'filament' => 'PETG',     'pieces' => 28, 'image' => 'products/st6.webp',  'file_format' => 'STL',      'colour' => 'White'],
            ['name' => 'Wheat',    'price' => 5.00,  'filament' => 'PLA',      'pieces' => 10, 'image' => 'products/st7.webp',  'file_format' => '3MF',      'colour' => 'Grey'],
            ['name' => 'The nut',       'price' => 9.00,  'filament' => 'PLA',      'pieces' => 24, 'image' => 'products/st8.webp',  'file_format' => 'STL',      'colour' => 'Natural'],
            ['name' => 'Tropical Fruit', 'price' => 35.00, 'filament' => 'PLA',      'pieces' => 14, 'image' => 'products/st9.webp',  'file_format' => 'OBJ',      'colour' => 'Yellow'],
            ['name' => 'Citrus Glow',    'price' => 22.00, 'filament' => 'PETG',     'pieces' => 30, 'image' => 'products/st10.webp', 'file_format' => 'STL',      'colour' => 'Orange'],
        ];

        foreach ($products as $data) {
            Product::create([
                'name'              => $data['name'],
                'price'             => $data['price'],
                'short_description' => 'A great 3D printable model.',
                'description'       => 'Detailed description of ' . $data['name'] . '. Includes ' . $data['file_format'] . ' files.',
                'filament'          => $data['filament'],
                'colour'            => $data['colour'],
                'pieces'            => $data['pieces'],
                'print_time'        => '~3 h',
                'supports'          => 'No',
                'infill'            => '15%',
                'layer_height'      => '0.2 mm',
                'file_format'       => $data['file_format'],
                'license'           => 'Personal use',
                'main_image'        => $data['image'],
                'rating_count'      => rand(10, 200),
                'rating_avg'        => round(rand(30, 50) / 10, 1),
                'user_id'           => $user->id,
            ]);
        }
    }
}