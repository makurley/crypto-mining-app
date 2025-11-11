<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Cache;
use App\Models\Withdrawal;
use App\Models\MiningPurchase;
use App\Models\ProfitHistory;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
protected $fillable = [
    'name',
    'username',
    'email',
    'address',
    'country',
    'role',
    'password',
    'referral_code',
    'referred_by',
    'server_status',
    'miner_ip',
    'miner_location',
    'kyc_document_type',
    'kyc_document',
    'kyc_status',
    'kyc_rejection_reason',
];


 protected $hidden = ['password'];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
public function isAdmin()
{
    return $this->role === 'admin';
}
public function transactions()
{
    return $this->hasMany(Transaction::class);
}

public function userPlans()
{
    return $this->hasMany(UserPlan::class);
}


public function isOnline()
{
    return Cache::has('user-is-online-' . $this->id);
}

 public function profits()
    {
        // Assuming the user has a relationship with a 'profit' model
        return $this->hasMany(ProfitHistory::class);
    }
    public function withdrawals()
{
    return $this->hasMany(\App\Models\Withdrawal::class);
}
public function miningPurchases()
{
    return $this->hasMany(MiningPurchase::class);
}
    public function miningProfits()
    {
        return $this->hasMany(MiningProfit::class);
    }
   public function profitHistories()
{
    return $this->hasMany(\App\Models\ProfitHistory::class, 'user_id', 'id');
}
protected static function booted()
{
    static::created(function ($user) {
        $user->referral_code = strtoupper(Str::random(10));
        $user->save();
    });
}

public function referrer()
{
    return $this->belongsTo(User::class, 'referred_by');
}
public function getReferralLinkAttribute()
{
    return url('/register?ref=' . $this->id);
}

// Users this user has referred
public function referrals()
{
    return $this->hasMany(User::class, 'referred_by');
}

// Referral rewards earned by this user
public function referralBonuses()
{
    return $this->hasMany(ReferralReward::class, 'referrer_id');
}
    
}


