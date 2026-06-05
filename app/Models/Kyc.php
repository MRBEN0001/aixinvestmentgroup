<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kyc extends Model
{
    use HasFactory;

    // Use guarded to prevent mass-assignment vulnerabilities
    protected $guarded = [];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
