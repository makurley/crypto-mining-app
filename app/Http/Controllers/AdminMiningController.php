<?php

namespace App\Http\Controllers;

use App\Models\MiningProfit;
use App\Models\MiningPurchase;
use Illuminate\Http\Request;

class AdminMiningController extends Controller
{
    public function index()
    {
        // Get all mining purchases, ordered by latest
        $miningPurchases = MiningPurchase::latest()->get();
        return view('admin.mining.index', compact('miningPurchases'));
    }

   public function payout(MiningPurchase $miningPurchase)
{
    // Ensure the mining plan has expired before processing payout
    if (now()->greaterThanOrEqualTo($miningPurchase->end_date)) {
        // Calculate the expected profit + total price
        $expectedProfit = $miningPurchase->expected_profit ?? 0;
        $payoutAmount = $miningPurchase->total_price + $expectedProfit;

        // Check if the user already has a paid or withdrawn mining profit
        $existingProfit = MiningProfit::where('mining_purchase_id', $miningPurchase->id)
                                      ->whereIn('status', ['paid', 'withdrawn'])
                                      ->first();
        if ($existingProfit) {
            return redirect()->route('admin.mining.index')
                             ->with('error', 'Profit for this purchase has already been paid or withdrawn.');
        }

        // Create a new mining profit entry with payout details
        MiningProfit::create([
            'user_id'            => $miningPurchase->user_id,
            'mining_purchase_id' => $miningPurchase->id,
            'profit_amount'      => $payoutAmount, // Total payout amount
            'paid_at'            => now(), // Set payout date
            'status'             => 'paid', // Mark status as paid
        ]);

        // Update the mining purchase status (optional, could be 'paid' or 'completed')
        $miningPurchase->update([
            'status' => 'paid', // Mark as paid once profit is processed
        ]);

        return redirect()->route('admin.mining.index')->with('success', 'Payout processed successfully!');
    }

    // Return error if mining plan is still active (not expired)
    return redirect()->route('admin.mining.index')->with('error', 'Mining plan is still active!');
}

}
