<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Withdrawal;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserWithdrawalNotificationMail;
use App\Mail\AdminWithdrawalNotificationMail;

class WithdrawalController extends Controller
{
    public function withdrawalFormIndex()
    {
        return view('user-dashboard-pages.withdrawal-form');
    }

    public function withdrawalProcess(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();
        $account = $user->account;

        if (!$account) {
            return back()->with('error', 'No account found for this user.');
        }

        if ($request->amount > $account->balance) {
            return back()->with('error', 'Insufficient funds.');
        }

        // Deduct amount
        $account->balance -= $request->amount;
        $account->save();

        // Log the transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'transaction_type' => 'withdrawal',
            'account_id' => $account->id,
            'amount' => $request->amount,
            'description' => 'User withdrawal',
            'status' => 'Success',

        ]);
        // Log to withdrawal table
        Withdrawal::create([
            'user_id' => $user->id,
            'transaction_id' => $transaction->id,
            'amount' => $request->amount,
            'status' => 'Success',

        ]);
        // Prepare email data
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'account_number' => $account->account_number,
            'amount' => $request->amount,
            'time' => now()->toDateTimeString(),
            'balance' => $account->balance,
            // 'balance' => number_format($account->balance, decimals: 2),
        ];
        try {
            Mail::to($user->email)->send(new UserWithdrawalNotificationMail($data));

            Mail::to('vaultfinance6@gmail.com')->send(new AdminWithdrawalNotificationMail($data));
        } catch (\Throwable $error) {
            Log::error('SMTP network error:' . $error->getMessage());
        }

        return back()->with('success', 'Withdrawal successful!');
    }
}
