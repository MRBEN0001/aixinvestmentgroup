<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'nullable|string',
        ]);

        $bank = Bank::create($request->all());

        return response()->json([
            'message' => 'Bank created successfully',
            'bank' => $bank
        ], 201);
    }
}
