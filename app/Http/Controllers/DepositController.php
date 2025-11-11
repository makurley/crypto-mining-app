<?php

namespace App\Http\Controllers;

use App\Models\AdminCryptoWallet;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function create()
    {
        $cryptoOptions = AdminCryptoWallet::all(); // to populate dropdown
        return view('user.deposit.create', compact('cryptoOptions'));
    }

   public function store(Request $request)
{
    $request->validate([
        'crypto_type' => 'required|string',
        'amount' => 'required|numeric|min:1',
    ]);

    $wallet = AdminCryptoWallet::where('crypto_name', $request->input('crypto_type'))->firstOrFail();

    $conversionRate = 1;
    $crypto = strtolower($request->input('crypto_type'));
    if ($crypto === 'bitcoin') {
        $conversionRate = 0.000025;
    } elseif ($crypto === 'ethereum') {
        $conversionRate = 0.00035;
    } elseif ($crypto === 'usdt') {
        $conversionRate = 1;
    }

    $cryptoAmount = $request->input('amount') / $conversionRate;

    // Create deposit
    $deposit = new Deposit();
    $deposit->user_id = Auth::id();
    $deposit->crypto_type = $request->input('crypto_type');
    $deposit->wallet_address = $wallet->wallet_address;
    $deposit->amount = $request->input('amount');
    $deposit->crypto_amount = $cryptoAmount;
    $deposit->save();
    $user = Auth::user();
     
    // Only reward if deposit >= 1000 and no prior reward exists
    if ($deposit->amount >= 1000 && $user->referred_by) {
        $alreadyRewarded = \App\Models\ReferralReward::where('referral_id', $user->id)->exists();

        if (!$alreadyRewarded) {
            \App\Models\ReferralReward::create([
                'referrer_id' => $user->referred_by,
                'referral_id' => $user->id,
                'reward_amount' => 50,
                'rewarded' => false, // Mark pending if you want admin to manually approve it
            ]);
        }
    }
 }
    // Method to show the deposit confirmation page
    public function confirmation($id)
    {
        $deposit = Deposit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.deposit.confirmation', compact('deposit'));
    }

    // Method to handle the confirmation submission
    public function confirm(Request $request, $id)
    {
        // Validate the confirmation input
        $request->validate([
            'user_confirm' => 'required|in:I\'ve made payment',  // Example validation rule for the confirmation text
        ]);

        // Find the deposit record
        $deposit = Deposit::findOrFail($id);

        // Update the deposit record with user confirmation
        $deposit->user_confirm = $request->input('user_confirm');
        $deposit->save();

        // Redirect to another page (e.g., dashboard or success page)
        return redirect()->route('dashboard')->with('success', 'Your deposit has been confirmed.');
    }
public function history()
{
    $deposits = Deposit::where('user_id', Auth::id())->latest()->get();
    return view('user.deposit.history', compact('deposits'));
}


}
