<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminCryptoWallet;

class AdminCryptoWalletController extends Controller
{
    public function index()
    {
        $wallets = AdminCryptoWallet::all();
        return view('admin.cryptowallets.index', compact('wallets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'crypto_name' => 'required|string|max:100',
            'wallet_address' => 'required|string',
        ]);

        AdminCryptoWallet::updateOrCreate(
            ['crypto_name' => $request->crypto_name],
            ['wallet_address' => $request->wallet_address]
        );

        return back()->with('success', 'Wallet updated successfully!');
    }
}
