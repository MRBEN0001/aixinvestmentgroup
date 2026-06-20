<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kyc extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dob',
        'address',
        'city',
        'state',
        'zip',
        'id_type',
        'id_front',
        'id_back',
        'passport_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
