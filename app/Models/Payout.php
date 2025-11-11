<?php

// app/Models/Payout.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = ['user_id', 'user_plan_id', 'amount', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function userPlan() {
        return $this->belongsTo(UserPlan::class);
    }
}
