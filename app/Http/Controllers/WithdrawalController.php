<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Enums\WithdrawalStatusEnum;
use App\Mail\WithdrawalRequestMail;
use App\Services\WithdrawalService; 

use Illuminate\Support\Facades\Log;
use App\Mail\InvestorWithdrawalMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\WithdrawalRequest;


class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = $this->getUserWithdrawals();
        $account = $this->getUserAccount();
        return view('user.dashboard.withdrawal.history')
            ->with('withdrawals', $withdrawals)
            ->with('account', $account);
    }

    public function withdrawalForm()
    {


        $coins = $this->getUserCoins();
        return view('user.dashboard.withdrawal.form')->with('coins', $coins);
    }

    public function withdraw(WithdrawalRequest $request)
    {
        $withdraw = (new WithdrawalService())->requestWithrawal($request);
        $selectedCoin = getSelectedCoin($request->coin);
    
        if ($withdraw['success'] == true) {
            try {
                // Prepare mail data
                $mailData = [
                    'name' => auth()->user()->name,
                    'amount' => $request->amount,
                    'coin' => $selectedCoin->companyWallet->coin,
                    'wallet_address' => $selectedCoin->wallet_address
                ];
    
                // Send email to admin
                Mail::to(config('app.mail_to'))->send(new WithdrawalRequestMail($mailData));
    
                // Send email to the investor 
                Mail::to(auth()->user()->email)->send(new InvestorWithdrawalMail($mailData));

                // Flash success message
                session()->flash('success', $withdraw['message']);
               
                return redirect('/withdrawals');
            } catch (\Throwable $error) {
                Log::error('SMTP network error: ' . $error->getMessage());
                return redirect('/withdrawals');
            }
        } else {
            session()->flash('danger', $withdraw['message']);
            return redirect('/withdraw');
        }
    }
    
}
