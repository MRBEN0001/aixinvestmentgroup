<?php

namespace Database\Seeders;

use App\Models\Coin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coin::create([
            'user_id' => 1,
            'account_id' => 1,
            'name' => 'Bitname',
            'wallet_address' => 'dkaljfp0493-u90pfohpadoa',
            'balance' => 4000.0
        ]);

        Coin::create([
            'user_id' => 1,
            'account_id' => 1,
            'name' => 'Ethereum',
            'wallet_address' => 'aljfp0da493-u90pfohpadoa',
            'balance' => 5550.0
        ]);

        Coin::create([
            'user_id' => 2,
            'account_id' => 2,
            'name' => 'Ethereum',
            'wallet_address' => 'aljfp0da493-u90pfohpadoa',
            'balance' => 5500.0
        ]);
        
        Coin::create([
            'user_id' => 2,
            'account_id' => 2,
            'name' => 'Ripple',
            'wallet_address' => 'aljfp0da493-u90pfohpadoa',
            'balance' => 500.0
        ]);
    }
}
