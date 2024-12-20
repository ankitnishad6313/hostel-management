<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'phone' => '0000000000',
        //     'password' => Hash::make(123456),
        //     'role' => 'admin',
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Owner',
        //     'email' => 'owner@gmail.com',
        //     'phone' => '0000000001',
        //     'password' => Hash::make(123456),
        //     'role' => 'owner',
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Agent',
        //     'email' => 'agent@gmail.com',
        //     'phone' => '0000000002',
        //     'password' => Hash::make(123456),
        //     'role' => 'agent',
        // ]);
    }
}
