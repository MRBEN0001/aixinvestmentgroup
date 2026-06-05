<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function transactionIndex(Request $request)
    {
        $user = Auth::user();

        $q = Transaction::where('user_id', $user->id);
        if ($request->filled('type')) {
            $q->where('transaction_type', $request->type);
        }
        $transactions = $q->latest()->paginate(10);

        return view('user-dashboard-pages.transactions', compact('transactions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'account_id' => 'required|exists:accounts,id',
            'transaction_type' => 'required|in:deposit,withdrawal,transfer,purchase',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
        ]);

        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'account_id' => $request->account_id,
            'transaction_type' => $request->transaction_type,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'confirmed',
        ]);

        return response()->json([
            'message' => 'Transaction stored successfully.',
            'transaction' => $transaction
        ], 201);
    }
}
