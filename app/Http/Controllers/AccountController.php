<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'account_number' => 'required|string|max:20|unique:accounts,account_number',
            'balance' => 'required|numeric|min:0',
        ]);

        // Create the account
        $account = Account::create([
            'user_id' => $validated['user_id'],
            'account_number' => $validated['account_number'],
            'balance' => $validated['balance'],
            'is_suspended' => false,
        ]);

        // Return a response
        return response()->json([
            'message' => 'Account created successfully.',
            'account' => $account
        ], 201);
    }
}
