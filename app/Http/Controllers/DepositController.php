<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositAdminNotificationMial;

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

    public function transactionHashProcess(Request $request)
    {
        $request->validate([
            'transaction_hash' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ]);


        $user = Auth::user();
        $account = $user->account;

        // Save to transactions table
        DB::beginTransaction();

        try {
            $transaction = new Transaction();
            $transaction->user_id = auth()->id();
            $transaction->account_id = $account->id;
            $transaction->transaction_type = 'deposit';
            $transaction->amount = $request->amount;
            $transaction->description = 'Deposit via USDC';
            $transaction->status = 'pending';
            $transaction->save();

            $deposit = new Deposit();
            $deposit->user_id = auth()->id();
            $deposit->transaction_id = $transaction->id;
            $deposit->amount = $request->amount;
            $deposit->reference = $request->transaction_hash;
            $deposit->status = 'pending';
            $deposit->save();

            DB::commit();
      
            // One variable carrying all data for the email
            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'account_number' => $account->account_number ?? 'N/A',
                'amount' => $request->amount,
                'reference' => $request->transaction_hash,
                'date' => now()->toDateTimeString(),
            ];

            // Send email to admin
            Mail::to('vaultfinance6@gmail.com')->send(new DepositAdminNotificationMial($data));


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
