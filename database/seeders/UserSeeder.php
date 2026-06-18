<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Coin;
use App\Models\CoinWallet;
use App\Models\Investment;
use App\Models\Profile;
use App\Models\ReferralCommission;
use App\Models\Withdrawal;
use Database\Factories\InvestmentFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->count(1)
        //     ->has(Account::factory(), 'account')
        //     ->has(Investment::factory(), 'investments')
        //     ->has(Withdrawal::factory()->count(1), 'withdrawals')
        //     ->has(ReferralCommission::factory(), 'commissions')
        //     ->has(Coin::factory(), 'coins')
        //     ->create();

        User::factory(1)->create()->each(function ($user) {
            $account = Account::factory(1)->create([
                'user_id' => $user->id,
            ]);

            $investment = Investment::factory(3)->create([
                'user_id' => $user->id,
            ]);

            $withdrawal = Withdrawal::factory([
                'user_id' => $user->id,
            ]);

            $commission = ReferralCommission::factory(3)->create([
                'user_id' => $user->id,
            ]);

            $coin = Coin::factory(1)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
