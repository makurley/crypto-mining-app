<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefWithdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RefBonusHistory;
class ReferralController extends Controller
{
public function withdrawBonus() 
{
    $user = Auth::user();
    $amount = $user->ref_bonus;

    if ($amount <= 0) {
        return back()->with('error', 'No referral bonus available to withdraw.');
    }

    // Add to wallet and reset referral bonus
    $user->wallet += $amount;
    $user->ref_bonus = 0;
    $user->save();

    // Record in ref_bonus_history table
    \DB::table('ref_bonus_history')->insert([
        'user_id' => $user->id,
        'amount' => $amount,
        'description' => 'Referral bonus withdrawn to wallet',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return back()->with('success', 'Referral bonus withdrawn successfully.');
}
public function history()
{
    $history = RefBonusHistory::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user.referral-history', compact('history'));
}
}
