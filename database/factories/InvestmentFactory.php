<?php

namespace Database\Factories;

use App\Models\Coin;
use App\Models\CoinWallet;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdrawal>
 */
class InvestmentFactory extends Factory
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
            'company_wallet_id' => Coin::factory(),
            'plan_id' => Plan::factory(),
            'amount' => fake()->randomFloat(2),
            'roi' => fake()->randomFloat(2),
        ];
    }
}
