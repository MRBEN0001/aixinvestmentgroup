<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Bronze',
            'duration' => 1,
            'max' => 10000,
            'min' => 1000,
            'percentage_return' => 5,
            'referral_bonus' => 5
        ]);

        Plan::create([
            'name' => 'Silver',
            'duration' => 2,
            'max' => 20000,
            'min' => 2000,
            'percentage_return' => 10,
            'referral_bonus' => 10
        ]);
        Plan::create([
            'name' => 'Gold',
            'duration' => 3,
            'max' => 30000,
            'min' => 3000,
            'percentage_return' => 15,
            'referral_bonus' => 15
        ]);
        Plan::create([
            'name' => 'Premium',
            'duration' => 4,
            'max' => 40000,
            'min' => 4000,
            'percentage_return' => 20,
            'referral_bonus' => 20
        ]);
    }
}
