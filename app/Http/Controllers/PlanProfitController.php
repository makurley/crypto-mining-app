<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfitHistory;

class PlanProfitController extends Controller
{
    public function withdrawProfit(Request $request)
    {
        $user = auth()->user();

        // Fetch profits marked as 'paid' and not yet withdrawn
        $profits = $user->profitHistories()
            ->where('payout_status', 'paid')
            ->where('payout_amount', '>', 0)
            ->get();

        $totalProfit = $profits->sum('payout_amount');

        if ($totalProfit <= 0) {
            return back()->with('error', 'No profit available for withdrawal.');
        }

        // Credit user's wallet
        $user->wallet += $totalProfit;
        $user->save();

        // Update each profit record
        foreach ($profits as $profit) {
            $profit->payout_amount = 0; // Mark as withdrawn
            $profit->payout_status = 'withdrawn'; // Optional: track status
            $profit->save();
        }

        return back()->with('success', 'Profit withdrawn successfully!');
    }

 

}
