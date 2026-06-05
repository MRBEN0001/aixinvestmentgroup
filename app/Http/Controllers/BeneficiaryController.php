<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'account_number' => 'required|string',
            'routing' => 'required|string',
            'bank_id' => 'required|exists:banks,id',
            'is_suspended' => 'nullable|string',
        ]);

        $beneficiary = Beneficiary::create($request->all());

        return response()->json([
            'message' => 'Beneficiary created successfully.',
            'beneficiary' => $beneficiary,
        ], 201);
    }
}
