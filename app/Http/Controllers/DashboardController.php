<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\CryptoWallet;
use App\Models\AdminCryptoWallet;
use App\Models\Deposit;
use App\Models\ProfitHistory;
use App\Models\MiningPurchase; 
use App\Models\ReferralReward;
class DashboardController extends Controller
{
public function index()
{
    $userId = Auth::id();
    $user = Auth::user();

    $wallets = CryptoWallet::where('user_id', $userId)->get();
    $cryptoOptions = AdminCryptoWallet::all();
    $deposits = Deposit::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

    $walletsRaw = CryptoWallet::where('user_id', $userId)
        ->pluck('wallet_address', 'wallet_type');

    $cryptoWallets = [];
    foreach ($walletsRaw as $type => $address) {
        $cryptoWallets[strtolower($type)] = $address;
    }

    $totalDeposit = Deposit::where('user_id', $userId)->sum('amount');
    $totalProfit = ProfitHistory::where('user_id', $userId)->sum('amount');

   $referralLink = url('/register?ref=' . Auth::user()->referral_code);
   $totalReferrals = \App\Models\User::where('referred_by', $userId)->count();
        $totalEarnedBonus = ReferralReward::where('referrer_id', $user->id)->sum('reward_amount');
       $referralBonus = $user->ref_bonus ?? 0;
    $server_status = true;

    return view('user.dashboard', compact(
        'wallets',
        'cryptoOptions',
        'deposits',
        'cryptoWallets',
        'totalDeposit',
        'totalProfit',
        'referralLink',
        'totalReferrals',
        'totalEarnedBonus',
        'referralBonus',
        'server_status'
    ));
}



    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully!']);
    }

    public function depositConfirmation($id)
    {
        $deposit = Deposit::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.deposit.confirmation', compact('deposit'));
    }

    public function createDeposit()
    {
        $cryptoOptions = AdminCryptoWallet::all();
        return view('user.deposit.create', compact('cryptoOptions')); // Suggest using a separate deposit form view
    }

    public function storeDeposit(Request $request)
    {
        Log::info('Deposit submitted', $request->all());

        $request->validate([
            'crypto_type' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $wallet = AdminCryptoWallet::where('crypto_name', $request->crypto_type)->first();
        if (!$wallet) {
            return back()->with('error', 'Wallet address not found.');
        }

        $conversionRates = [
            'bitcoin' => 0.000025,
            'ethereum' => 0.00035,
            'usdt' => 1
        ];

        $rate = $conversionRates[strtolower($request->crypto_type)] ?? 1;
        $cryptoAmount = $request->amount / $rate;

        $deposit = Deposit::create([
            'user_id' => auth()->id(),
            'crypto_type' => $request->crypto_type,
            'wallet_address' => $wallet->wallet_address,
            'amount' => $request->amount,
            'crypto_amount' => $cryptoAmount,
        ]);

        return redirect()->route('user.deposit.confirmation', $deposit->id)
            ->with('success', 'Deposit request created.');
    }
   public function updateCryptoWallets(Request $request)
{
    $request->validate([
        'btc' => 'nullable|string|max:255',
        'eth' => 'nullable|string|max:255',
        'usdt' => 'nullable|string|max:255',
    ]);

    $userId = Auth::id();
    $walletTypes = ['btc', 'eth', 'usdt'];

    foreach ($walletTypes as $type) {
        if ($request->filled($type)) {
            CryptoWallet::updateOrCreate(
                ['user_id' => $userId, 'wallet_type' => strtoupper($type)],
                ['wallet_address' => $request->input($type)]
            );
        }
    }

    return back()->with('success', 'Wallet addresses updated successfully!');
}

}
