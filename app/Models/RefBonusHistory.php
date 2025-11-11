<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefBonusHistory extends Model
{
    protected $table = 'ref_bonus_history';

    protected $fillable = [
        'user_id',
        'description',
        'amount',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}