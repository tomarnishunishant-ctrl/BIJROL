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
            NewsSeeder::class,
            EventSeeder::class,
        ]);

        User::updateOrCreate([
            'email' => env('ADMIN_EMAIL', 'admin@bijrol.local'),
        ], [
            'name' => env('ADMIN_USERNAME', 'admin'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
            'is_admin' => true,
        ]);
    }
}
