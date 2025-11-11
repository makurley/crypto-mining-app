<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index()
{
    $transactions = Auth::user()->transactions()->latest()->get();
    return view('wallet.index', compact('transactions'));
}

public function fund(Request $request)
{
    $request->validate(['amount' => 'required|numeric|min:1']);

    $user = Auth::user();
    $user->increment('wallet', $request->amount);

    Transaction::create([
        'user_id' => $user->id,
        'type' => 'credit',
        'amount' => $request->amount,
        'description' => 'Wallet funded',
    ]);

    return back()->with('message', 'Wallet funded successfully!');
}
}
