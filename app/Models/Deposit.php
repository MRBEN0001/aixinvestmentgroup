<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function companyWallet(): BelongsTo
    {
        return $this->belongsTo(CompanyWallet::class);
    }

    public function scopeExchange($query)
    {
        return $query->where('source', 'exchange');
    }

    public function scopeInvestment($query)
    {
        return $query->where('source', 'investment');
    }
    
}
