<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Beneficiary;


use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;  

class BeneficiarySeeder extends Seeder
{
    public function run()
    {
        // Seed 10 beneficiaries with random data
        $banks = Bank::all(); // Get all banks to assign them to beneficiaries

        if ($banks->count() > 0) {
            foreach (range(1, 10) as $index) {
                Beneficiary::create([
                    'name' => 'Beneficiary ' . $index,
                    'account_number' => 'ACC' . rand(100000, 999999),  // Random account number
                    'bank_id' => $banks->random()->id,  // Randomly pick a bank for the beneficiary
                    'is_suspended' => null,  // Optionally set it to null or any value
                ]);
            }
        } else {
            $this->command->info('No banks available to assign to beneficiaries.');
        }
    }
}
