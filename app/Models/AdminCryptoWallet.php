<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminCryptoWallet extends Model
{
    
    protected $table = 'admin_crypto_wallets';

    protected $fillable = [
        'crypto_name',
        'wallet_address',
    ];
}
