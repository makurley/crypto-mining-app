<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
   protected $fillable = [
    'user_id', 'user_plan_id', 'amount', 'payout_amount', 'payout_at',
    'payout_status', 'transaction_id', 'description'
];

    public function userPlan() {
        return $this->belongsTo(UserPlan::class);
    }
}
