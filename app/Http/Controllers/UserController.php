<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Account;
use App\Models\Deposit;
use App\Mail\DepositAdminNotificationMial;
use App\Models\CoinWallet;
use Illuminate\Http\Request;
use App\Models\CompanyWallet;
use App\Services\UserService;
use App\Services\AccountService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AccountRequest;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function earningHistory($id)
    {
        $this->userService->getEarnings($id);
        return view('user.dashboard.earnings');
    }

    public function referrals()
    {
        $referrals = $this->userService->getReferrals();
        return view('user.my-referrals')->with('referrals', $referrals);
    }

    public function setUpAccount()
    {
        $companyWallets = CompanyWallet::all();

        return view('user.account.setup')->with('companyWallets', $companyWallets);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = auth()->user();

            $formRequest[] = $request->all();

            foreach ($formRequest[0] as $key => $value) {
                if (($key == '_token') || ($value == null)) {
                    continue;
                }
                Coin::create([
                    'user_id' => $user->id,
                    'company_wallet_id' => $key,
                    'wallet_address' => $value,
                    'balance' => 0.0
                ]);
            }

            Account::create([
                'user_id' => auth()->user()->id
            ]);
        });


        session()->flash('success', 'Account succesfully created');
        return redirect('/dashboard');
    }

    public function editAccount()
    {
        $coins = $this->getUserCoins();
        return view('user.account.edit')->with('coins', $coins);
    }

    public function updateAccount(AccountRequest $request, $id)
    {
        $this->userService->updateAccount($request, $id);
        session()->flash('success', 'Account succesfully updated');
        return redirect('/dashboard');
    }

    public function referralCommissions($id)
    {
        $this->userService->getReferralCommissions($id);
        return view('user.commission');
    }

    public function deposit()
    {
        $coins = $this->getUserCoins();
        return view('user.account.deposit.new')->with('coins', $coins);
    }

    public function depositHistory()
    {
        $pendingDeposit = false;
        if ($this->myPendingDeposit()) {
            $pendingDeposit = true;
        }
        return view('user.account.deposit.history')->with(['deposits' => me()->deposits, 'pendingDeposit' => $pendingDeposit]);
    }

    public function createDeposit(Request $request)
    {
        Deposit::create([
            'user_id' => me()->id,
            'company_wallet_id' => $request->coin,
            'amount' => $request->amount,
            'reference' => $request->reference,
        ]);
        session()->flash('success', 'Deposit Submitted Succesfully');
        return redirect('/deposit/reference');
    }

    public function addDepositReference()
    {
        $walletAddress = CompanyWallet::find($this->myPendingDeposit()->company_wallet_id)->wallet_address;
        return view('user.account.deposit.reference')->with(['deposit' => $this->myPendingDeposit(), 'walletAddress' => $walletAddress]);
    }

    public function submitDepositReference(Request $request, $id)
    {
        $deposit = Deposit::with(['user.account', 'companyWallet'])->findOrFail($id);
        $deposit->update([
            'reference' => $request->reference,
        ]);

        $data = [
            'name' => $deposit->user->name,
            'email' => $deposit->user->email,
            'account_number' => $deposit->user->account?->id ?? $deposit->user_id,
            'amount' => $deposit->amount,
            'reference' => $request->reference,
            'coin' => $deposit->companyWallet->coin,
            'date' => now()->toDateTimeString(),
        ];

        try {
            Mail::to(adminMailTo())->send(new DepositAdminNotificationMial($data));
        } catch (\Throwable $error) {
            Log::error('Deposit admin notification failed: ' . $error->getMessage());
        }

        session()->flash('success', 'You will recieve an email as soon as your deposit is approaved');
        return redirect('/deposits');
    }

    public function cancelDepost($id)
    {
        session()->forget('message');

        Deposit::find($id)->delete();
        session()->flash('success', 'Deposit cancelled succesfully. You may proceed to a new deposit request');
        return redirect('/deposits');
    }
}
