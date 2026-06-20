<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            DataCenterSeeder::class,
            ArticleSeeder::class,
        ]);

        // Create regular user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@datacenterpro.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@datacenterpro.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
