<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_wallet_id',
        'plan_id',
        'amount',
        'roi',
        'transaction_reference',
        'due_date',
        'status',
        'has_withdrawn',
        'start_date',
        'next_payment_date',
        'working_days_paid',
        'last_payment_date',
        'payment_option'
    ];

    protected $casts = [
        'last_payment_date' => 'datetime',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function withdrawal(): HasOne
    {
        return $this->hasOne(Withdrawal::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function companyWallet(): BelongsTo
    {
        return $this->belongsTo(CompanyWallet::class);
    }
}
