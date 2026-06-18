<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Investment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdrawal>
 */
class WithdrawalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'company_Wallet_id' => 1,
            'amount' => fake()->randomFloat(2),
            'status' => fake()->randomElement(['approaved', 'declined', 'pending']),
        ];
    }
}
