<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'referral_link',
        'referral',
        'account_disabled',
        'is_investing_suspended',
        'password',
        'trade_password',
        'ip_address',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'trade_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, 'admin@ggraton.com');
    }

    public function hasTradePassword(): bool
    {
        return filled($this->trade_password);
    }

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    public function activeInvestments()
    {
        return Investment::Where('status', 'Active')->get();
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(ReferralCommission::class);
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function coins(): HasMany
    {
        return $this->hasMany(Coin::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }
    public function kyc()
    {
        return $this->hasOne(Kyc::class);
    }
    public function walletKyc()
{
    return $this->hasOne(WalletKyc::class);
}

}
