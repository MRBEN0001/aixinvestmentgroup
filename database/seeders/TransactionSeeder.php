<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Create 10 transactions for testing
    for ($i = 1; $i <= 20; $i++) {
        Transaction::create([
            'user_id' => 1, // Make sure user with ID 1 exists
            'account_id' => 1, // Make sure account with ID 1 exists
            'transaction_type' => collect(['deposit', 'withdrawal', 'transfer', 'purchase'])->random(),
            'amount' => rand(100, 1000), // Random amount between 100 and 1000
            'description' => 'Test transaction ' . $i,
            'status' => collect(['pending', 'success', 'cancelled'])->random(), // Random status
        ]);
    }
}

}
