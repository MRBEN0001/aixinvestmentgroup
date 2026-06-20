<?php

namespace Database\Seeders;

use App\Models\Wallet;
use App\Models\CompanyWallet;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanyWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyWallet::create([
            'coin' => 'Bitcoin',
            'abbr' => 'BTC',
            'wallet_address' => '15xg5x5xbxbxbxb66bdx6b5xb6x6b6',
        ]);

        CompanyWallet::create([
            'coin' => 'Ethereum',
            'abbr' => 'ETH',
            'wallet_address' => '15xg5x5xbxbxbxb66bdx6b5xb6x6c5',
        ]);

        CompanyWallet::create([
            'coin' => 'Tron',
            'abbr' => 'TRN',
            'wallet_address' => '15xg5x5xbxbxbxb66bdx6b5xb6x6t7',
        ]);

        CompanyWallet::create([
            'coin' => 'Ripple',
            'abbr' => 'RIPP',
            'wallet_address' => '15xg5x5xbxbxbxb66bdx6b5xb6x645',
        ]);

        CompanyWallet::create([
            'coin' => 'Binnance',
            'abbr' => 'BNB',
            'wallet_address' => '15xg5x5xbxbxbxb66bdx6b5xb6x65t',
        ]);
        CompanyWallet::create([
            'coin' => 'Cadano',
            'abbr' => 'CAD',
            'wallet_address' => '15xg5x5xbxbxbxb66bdx6b5xb6x6b3',
        ]);
    }
}
