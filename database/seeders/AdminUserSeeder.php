<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if user already exists to avoid duplicates
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Titolare',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // You can change 'password' to something else if needed
                // 'is_admin' => true, // Uncomment if is_admin column exists
            ]);
            
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
