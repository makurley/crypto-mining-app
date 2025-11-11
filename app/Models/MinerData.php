<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinerData extends Model
{
    use HasFactory;

    // Make sure to specify which attributes are mass assignable
    protected $fillable = [
        'miner_location', 'miner_ip', 'up_time', 'status',
    ];
}
