<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\CryptoWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function showForm()
    {
        $wallets = CryptoWallet::where('user_id', Auth::id())->get();
        return view('user.withdraw.create', compact('wallets'));
    }

    public function store(Request $request)
    {
        $wallet = CryptoWallet::where('user_id', Auth::id())
                  ->where('wallet_type', $request->wallet_type)->first();

        $withdrawal = Withdrawal::create([
            'user_id' => Auth::id(),
            'wallet_type' => $request->wallet_type,
            'wallet_address' => $wallet->wallet_address,
            'amount' => $request->amount,
            'status' => 'pending'
        ]);

        return redirect()->route('user.withdraw.confirmation', $withdrawal->id);
    }

    public function confirmation($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        return view('user.withdraw.confirmation', compact('withdrawal'));
    }
    public function history()
{
    $withdrawals = Withdrawal::where('user_id', Auth::id())->latest()->get();
    return view('user.withdraw.history', compact('withdrawals'));
}
}
