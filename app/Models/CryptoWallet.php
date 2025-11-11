<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoWallet extends Model
{
    protected $fillable = ['user_id', 'wallet_type', 'wallet_address'];

    // Define any other relationships or methods
}
