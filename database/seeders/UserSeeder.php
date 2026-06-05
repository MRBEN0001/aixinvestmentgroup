<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Creating 2 users
    foreach (range(1, 2) as $index) {
        User::create([
            'name' => 'User' . $index, // Example: User 1, User 2, etc.
            'username' => 'user_' . $index,
            'email' => 'user' . $index . '@example.com',
            'password' => Hash::make('password123'),
            'phone' => '1234567890',
            'address' => '123 Main St',
            'dob' => '1990-01-01',
            'country' => 'USA',
            'city_or_state' => 'California',
            'postal_code' => '90001',
            'ip_address' => '192.168.0.1',
            'role' => 'admin',  // You can change this to 'customer' or 'admin' randomly if needed
            'is_active' => true,
            'is_notification_enable' => true,
            'is_two_factor_auth_enable' => false,
            'profile_image' => null,
        ]);
    }
}
}
