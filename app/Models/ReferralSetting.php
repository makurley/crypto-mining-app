<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
    protected $fillable = ['bonus_amount', 'referral_active'];

    public $timestamps = false;
}
