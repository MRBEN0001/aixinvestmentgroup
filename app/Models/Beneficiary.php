<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'account_number',
        'routine', 
        'bank_id',
        'is_suspended',
    ];

    // Relationships
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}


}
