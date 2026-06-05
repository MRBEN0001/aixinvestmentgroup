<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];


    // Define the inverse relationship (many beneficiaries can belong to one bank)
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
    public function account()
    {
        return $this->hasOne(Account::class);
    }
    
}
