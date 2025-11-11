<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiningProfit extends Model
{
    use HasFactory;

    // Specify the table name explicitly if it's different from Laravel's convention
    protected $table = 'mining_profit';

    protected $fillable = [
        'user_id',
        'mining_purchase_id',
        'profit_amount',
        'status', // paid, pending, etc.
        'paid_at',
    ];

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to mining purchase
    public function miningPurchase()
    {
        return $this->belongsTo(MiningPurchase::class);
    }
}

