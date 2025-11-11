<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  protected $fillable = ['name', 'hashrate', 'price', 'asset_id', 'duration', 'roi_type', 'roi_value', 'expected_profit', 'power_charge','sold_out','badge'];


    public function asset() {
        return $this->belongsTo(Asset::class);
    }

    public function userPlans() {
        return $this->hasMany(UserPlan::class);
    }
}
