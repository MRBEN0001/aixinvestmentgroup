<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletKyc extends Model
{
    use HasFactory;

    // allow all fields for mass assignment
    protected $guarded = [];

    // relationship: each WalletKyc belongs to one User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

