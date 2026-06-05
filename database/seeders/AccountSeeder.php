<?php

namespace Database\Seeders;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Example: Seed 10 random accounts
          for ($i = 1; $i <= 10; $i++) {
            Account::create([
                'user_id' => 1, // make sure this user exists
                'account_number' => 'ACC' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'balance' => rand(1000, 50000),
                'is_suspended' => false,
            ]);
        }
  
    }
}
