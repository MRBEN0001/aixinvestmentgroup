<?php

namespace App\Services;

use App\Models\Coin;
use App\Models\Plan;
use App\Models\Investment;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WithdrawalService
{
    public function requestWithrawal($request)
    {

        $transactionResponse = DB::transaction(function () use ($request) {
            $response = [];
            $investment = Investment::where('user_id', auth()->user()->id)->where('has_withdrawn', false)->latest()->first();

            $myCoin = getSelectedCoin($request->coin);

            if ($myCoin->balance < $request->amount) {
                $response = ['success' => false, 'message' => 'You do not have sufficient balance to perform this transaction'];
            } else {
                $myCoin->update([
                    'balance' => $myCoin->balance - $request->amount
                ]);
                me()->account->update([
                    'balance' => me()->account->balance - $request->amount
                ]);

                Withdrawal::create([
                    'user_id' => auth()->user()->id,
                    'company_wallet_id' => $request->coin,
                    'amount' => $request->amount,
                ]);
                $response = ['success' => true, 'message' => 'You have successully submitted your withdrawal request'];
            }

            return $response;
        });

        return $transactionResponse;
    }

    public function updateWithdrawalStatus()
    {
    }
}
