<?php

namespace App\Http\Controllers;

use App\Models\CompanyWallet;
use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositAdminNotificationMial;
use App\Services\AixcoinPriceService;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user-dashboard-pages.deposit.index');
    }

    public function crypto()
    {
        return view('user-dashboard-pages.deposit.crypto');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function transactionHashIndex()
    {
        return view('user-dashboard-pages.deposit.transaction-hash');
    }

    public function transactionHashProcess(Request $request, string $source = 'investment')
    {
        $request->validate([
            'transaction_hash' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $account = $user->account;
        $amount = (float) $request->amount;
        $transactionAmount = $amount;

        DB::beginTransaction();

        try {
            $transaction = new Transaction();
            $transaction->user_id = auth()->id();
            $transaction->account_id = $account->id;
            $transaction->transaction_type = 'deposit';
            $transaction->amount = $transactionAmount;

            if ($source === 'exchange') {
                $aixPrice = max(app(AixcoinPriceService::class)->current(), 0.0001);
                $units = round($amount / $aixPrice, 8);
                $unitLabel = rtrim(rtrim(number_format($units, 8), '0'), '.') . ' AIX';
                $transaction->description = $unitLabel . ' · $' . number_format($amount, 2);
            } else {
                $transaction->description = 'Deposit via USDC';
            }

            $transaction->status = 'pending';
            $transaction->source = $source;
            $transaction->save();

            $deposit = new Deposit();
            $deposit->user_id = auth()->id();
            $deposit->transaction_id = $transaction->id;
            $deposit->amount = $amount;
            $deposit->reference = $request->transaction_hash;
            $deposit->status = 'pending';
            $deposit->source = $source;

            if ($source === 'exchange') {
                $aixWallet = CompanyWallet::query()->where('abbr', 'AIX')->first();

                if (! $aixWallet) {
                    DB::rollBack();

                    return redirect()->back()->with('error', 'Aixcoin deposit is not configured yet. Please contact support.');
                }

                $deposit->company_wallet_id = $aixWallet->id;
            }

            $deposit->save();

            DB::commit();

            if ($source === 'exchange') {
                $mail = app(\App\Services\ExchangeMailService::class);
                $amountLabel = $transaction->description ?: ('$' . number_format($amount, 2));

                $mail->notifyTransaction($user, [
                    'type' => 'deposit',
                    'title' => 'Deposit Submitted',
                    'subject' => 'AIX Exchange Deposit Submitted',
                    'message' => 'Your Aixcoin deposit has been submitted and is awaiting blockchain confirmation.',
                    'amount_label' => $amountLabel,
                    'status' => 'pending',
                    'reference' => $request->transaction_hash,
                    'reference_label' => 'Transaction Hash',
                ]);

                $mail->notifyAdmin([
                    'type' => 'deposit',
                    'title' => 'New Exchange Deposit',
                    'subject' => 'AIX Exchange Deposit Notification',
                    'name' => 'Admin',
                    'message' => $user->name . ' (' . $user->email . ') submitted an Aixcoin deposit on AIX Exchange.',
                    'amount_label' => $amountLabel,
                    'status' => 'pending',
                    'reference' => $request->transaction_hash,
                    'reference_label' => 'Transaction Hash',
                ]);

                return redirect()->back()->with('success', 'Deposit submitted successfully. Awaiting blockchain confirmation.');
            }

            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'account_number' => $account->account_number ?? 'N/A',
                'amount' => $amount,
                'reference' => $request->transaction_hash,
                'date' => now()->toDateTimeString(),
            ];

            Mail::to(adminMailTo())->send(new DepositAdminNotificationMial($data));

            return redirect()->back()->with('success', 'Deposit submitted successfully. Awaiting confirmation.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
