<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralReward extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'referred_user_id',
        'reward_amount',
    ];

    // Relationship to referrer
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    // Relationship to the user who was referred
    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}
