<?php

namespace App\Services;

use App\Models\Coin;
use App\Models\Plan;
use App\Models\User;
use App\Models\Setting;
use App\Models\Investment;
use App\Models\CompanyWallet;
use Illuminate\Support\Carbon;
use App\Models\ReferralCommission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvestmentActivatedMail;
use App\Mail\NewInvestmentNotificationMail;

class InvestmentService
{
    public function createInvestment($request)
    {
        $response = [];
        $requestedCoin = Coin::where('user_id', me()->id)->where('company_Wallet_id', $request->coin)->first();
        $requestedCoinBalance = $requestedCoin->balance;

        if (!$this->eligibleInvestment($request->amount, $request->plan)) {
            $response = ['success' => false, 'message' => Null];
            return $response;
        }
        if ((float)$request->amount > (float)$requestedCoinBalance) {
            $response = ['success' => false, 'message' => 'You do not have sufficient balance for the amount you want to invest. Consider reducing the amount or deposit to your wallet'];
            return $response;
        }
        // $paymentOption = $this->determinePaymentOption($requestedCoin->balance, $request->amount);
        DB::transaction(function () use ($request, $requestedCoin) {
            $user = auth()->user();
            $investment = Investment::create([
                'user_id' => $user->id,
                'company_wallet_id' => $request->coin,
                'plan_id' => $request->plan,
                'amount' => $request->amount,
                'roi' => $this->getRoi($request->amount, $request->plan),
                'start_date' => Carbon::today()->nextWeekday(),
                'next_payment_date' => Carbon::today()->nextWeekday(),
                'working_days_paid' => 0,
                'last_payment_date' => null,
                'payment_option' => 'wallet'
            ]);

            $requestedCoin->update([
                'balance' => $requestedCoin->balance - $request->amount
            ]);

            me()->account->update([
                'balance' => me()->account->balance - $request->amount
            ]);

            $investment->update(['status' => investmentStatuses()['active']]);

            try {
                Mail::to(me()->email)->send(new InvestmentActivatedMail([
                    'name' => me()->name,
                    'amount' => $investment->amount,
                    'coin' => $investment->companyWallet->coin,
                    'due_date' => $investment->start_date
                ]));
            } catch (\Throwable $error) {
                Log::error('SMTP network error:' . $error->getMessage());
                // $this->notify('error', 'Failed to send Investment Activation email, but Investment Activated');
                return back();
            }

            if ($user->referral) {
                ReferralCommission::create([
                    'user_id' => $this->getInvestorReferral($user->id)->id,
                    'investment_id' => $investment->id,
                    'commission' => $this->getReferralBonus($request->amount)
                ]);
            }
        });
        // $response = ['success' => true, 'message' => 'You will recieve an email as soon as your transaction is approved'];
        $response = ['success' => true, 'message' => 'Your investment is now active.'];

        return $response;
    }

    public function getWalletAddress($id)
    {
        $coin = CompanyWallet::find($id);
        return $coin->wallet_address;
    }

    public function saveTransactionReference($reference, $id)
    {
        $investment = Investment::find($id);
        $investment->update([
            'transaction_reference' => $reference
        ]);
        try {
            Mail::to(config('app.mail'))->send(new NewInvestmentNotificationMail([
                'coin' => $investment->companyWallet->coin,
                'amount' => $investment->amount,
                'user' => $investment->user->name
            ]));
        } catch (\Throwable $error) {
            Log::error('SMTP network error:' . $error->getMessage());
        }

        return true;
    }

    public function investmentDueDate()
    {
    }

    private function determinePaymentOption($balance, $investmentAmount)
    {
        return $balance >= $investmentAmount ? 'wallet' : 'deposit';
    }

    private function getReferralBonus($amount)
    {
        $percentage = Setting::where('key', 'referral_commission')->first();
        $bonus = ($amount * $percentage->value) / 100;
        return $bonus;
    }

    private function getRoi($amount, $id)
    {
        $selectedPlan = Plan::find($id);
        $return = $selectedPlan->percentage_return;
        $roi = ($amount * $return) / 100;
        return $roi;
    }

    private function eligibleInvestment($amount, $id)
    {
        $isEligible = false;
        $selectedPlan = Plan::find($id);
        if (($amount <= $selectedPlan->max) && ($amount >= $selectedPlan->min)) {
            $isEligible = true;
        }
        return $isEligible;
    }

    private function getInvestorReferral($investor)
    {
        $user = User::find($investor);
        $userReferralId = $user->referral;
        $referral = User::where('referral_link', $userReferralId)->first();
        return $referral;
    }
}
