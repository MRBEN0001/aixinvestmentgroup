<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Card::create([
                'user_id' => 1, // make sure user ID 1 exists
                'account_id' => 1, // make sure account ID 1 exists
                'card_number' => str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT),
                'card_type' => collect(['debit', 'credit'])->random(),
                'expiration_date' => now()->addYears(rand(1, 5))->format('Y-m-d'),
                'cvv' => str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT),
                'status' => collect(['active', 'inactive'])->random(),
            ]);
        }
    }
}
