<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiningPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'crypto_type',
        'hashrate',
        'price_per_ths',
        'total_price',
        'duration_days',
        'expected_profit',
        'status',
        'start_date',
        'end_date',
        'completed_at',
        'profit_paid_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
     public function profits()
    {
        return $this->hasMany(MiningProfit::class);
    }
}
