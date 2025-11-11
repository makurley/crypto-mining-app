<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CryptoWallet;

class CryptoWalletController extends Controller
{
  
     
   public function update(Request $request)
{
    // Validate the incoming request to ensure data format is correct
    $request->validate([
        'btc' => 'nullable|string|size:34',  // For BTC wallet address
        'eth' => 'nullable|string|size:42',  // For ETH wallet address
        'usdt' => 'nullable|string',         // For USDT wallet address
    ]);

    // Get the currently authenticated user
    $user = Auth::user();

    // Loop through the wallet types (BTC, ETH, USDT) and update or create each one
    foreach (['btc', 'eth', 'usdt'] as $type) {
        if ($request->filled($type)) {
            CryptoWallet::updateOrCreate(
                [
                    'user_id' => $user->id,  // Ensure you're updating the correct user's wallet
                    'wallet_type' => strtoupper($type),  // Store wallet type as uppercase (BTC, ETH, USDT)
                ],
                [
                    'wallet_address' => $request->$type,  // The new wallet address
                ]
            );
        }
    }

    // Redirect to the dashboard with a success message after updating the wallet addresses
    return redirect()->route('user.dashboard')
        ->with('success', 'Crypto wallet addresses updated successfully!');
}

public function showForm()
{
    $walletsRaw = CryptoWallet::where('user_id', auth()->id())
        ->pluck('wallet_address', 'wallet_type');

    $cryptoWallets = [];

    foreach ($walletsRaw as $type => $address) {
        $cryptoWallets[strtolower($type)] = $address;
    }

    return view('user.dashboard', compact('cryptoWallets'));
}
    
}
