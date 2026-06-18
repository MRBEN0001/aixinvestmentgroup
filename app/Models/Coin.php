<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'account_id', 'company_wallet_id', 'wallet_address', 'balance'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function companyWallet(): BelongsTo
    {
        return $this->belongsTo(CompanyWallet::class);
    }

    protected $attributes = [
        'wallet_address' => '[]',
    ];

}
