<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@wtech.com'],
            [
                'name'     => 'Admin',
                'password' => bcrypt('admin1234'),
                'is_admin' => true,
            ]
        );

        $this->command->info('Admin created: admin@wtech.com / admin1234');
    }
}