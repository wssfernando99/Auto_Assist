<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'userId' => uniqid(),
            'name' => 'Sarindu Fernando',
            'email' => 'fernando@gmail.com',
            'role' => 'Admin',
            'contact' =>'0766674922',
            'isActive' => 1,
            'password' => Hash::make('123'),

        ]);
    }
}
