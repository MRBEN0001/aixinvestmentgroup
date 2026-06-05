<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'account_id' => 'required|exists:accounts,id',
            'card_number' => 'required|string|size:16|unique:cards,card_number',
            'card_type' => 'required|in:debit,credit',
            'expiration_date' => 'required|date|after:today',
            'cvv' => 'required|string|min:3|max:4',
            'status' => 'required|in:active,inactive',
        ]);

        $card = Card::create($request->all());

        return response()->json([
            'message' => 'Card created successfully.',
            'card' => $card
        ], 201);
    }
}
