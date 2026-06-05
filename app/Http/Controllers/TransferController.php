<?php

namespace App\Http\Controllers;
use App\Models\Bank;
use App\Models\User;
use App\Models\Account;
use App\Models\Beneficiary;
use App\Models\Transaction;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class TransferController extends Controller
{
    public function transferFormIndex()
{
    $banks = Bank::all(); 
    return view('user-dashboard-pages.transfer-form', compact('banks'));
}




public function ajaxValidate(Request $request)
{
    $request->validate([
        'account_number' => 'required|string',
        // 'routine' => 'required|string',
        'bank' => 'required|exists:banks,id',
    ]);

    $beneficiary = Beneficiary::where('account_number', $request->account_number)
        ->where('bank_id', $request->bank)
        ->with('bank') // To fetch bank name
        ->first();

    if ($beneficiary) {
        return response()->json([
            // 'account_number' => $beneficiary->account_number,
            // 'bank_name' => $beneficiary->bank->name ?? 'Unknown Bank',
            'name' => $beneficiary->name,
        ]);
    }

    return response()->json(['error' => 'Account not found.'], 404);
}



public function processTransfer(Request $request)
{
    $request->validate([
        'account_number' => 'required|string',
        // 'routine' => 'required|string',
        'bank' => 'required|integer|exists:banks,id',
        'amount' => 'required|numeric|min:1',
    ]);

    $sender = Auth::user();

    // Assuming sender has one account for now
    $senderAccount = me()->account; 

    if (!$senderAccount || $senderAccount->balance < $request->amount) {
        return back()->with('error', 'Insufficient balance.');
    }

    // Look up beneficiary
    $beneficiary = Beneficiary::where('account_number', $request->account_number)
        ->where('bank_id', $request->bank)
        ->first();

    if (!$beneficiary) {
        return back()->with('error', 'Beneficiary not found.');
    }

    // Optional: simulate transfer or process via external API if needed

    // Deduct balance
    $senderAccount->balance -= $request->amount;
    $senderAccount->save();

    // Log transaction
    Transaction::create([
        'user_id' => $sender->id,
        'account_id' => $senderAccount->id,
        'transaction_type' => 'transfer',
        'amount' => $request->amount,
        'description' => "Transfer to {$beneficiary->name} ({$beneficiary->account_number}) - {$beneficiary->bank->name}",
        'beneficiary_id' => $beneficiary->id,
        'status' => 'success',
    ]);

    return back()->with('success', 'Transfer completed successfully!');
    // return redirect('/transactions')->with('success', 'Transfer completed successfully!');
}



}
