<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    protected $fillable = [
        'user_id', 'plan_id', 'price', 'expected_profit', 'roi_value', 
        'roi_type', 'asset_id', 'status', 'started_at', 'expires_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profits()
    {
        return $this->hasMany(Profit::class);
    }
    
}
