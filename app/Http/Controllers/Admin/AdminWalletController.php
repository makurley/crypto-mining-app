<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminCryptoWallet;

class AdminWalletController extends Controller
{
    // Method to display the list of crypto wallets
    public function index()
    {
        $wallets = AdminCryptoWallet::all();
        return view('admin.cryptowallets.index', compact('wallets'));
    }

    // Method to store a new crypto wallet
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'crypto_name' => 'required|string|max:255',
            'wallet_address' => 'required|string|max:255',
        ]);

        // Create and save the new wallet record
        AdminCryptoWallet::create([
            'crypto_name' => $request->crypto_name,
            'wallet_address' => $request->wallet_address,
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.cryptowallets.index')->with('success', 'Crypto wallet created successfully!');
    }
}
