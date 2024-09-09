<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Exercise;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected static ?string $password;

    public function run(): void
    {
        // User::factory(10)->create();
        Exercise::factory(10)->create();

        // Super Admin Seeder
        // User::factory()->create([
        //     'name' => 'Super Admin',
        //     'email' => 'test@example.com',
        //     'role' => 'admin',
        //     'email_verified_at' => now(),
        //     'password' => static::$password ??= Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ]);
    }
}
