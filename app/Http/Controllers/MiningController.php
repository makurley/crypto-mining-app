<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MiningPurchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\MiningProfit;

class MiningController extends Controller
{
    public function create()
    {
        return view('user.mining.purchase');
    }
public function store(Request $request)
{
    $validated = $request->validate([
        'crypto_type' => 'required|string',
        'hashrate' => 'required|numeric|min:1',
        'price_per_ths' => 'required|numeric|min:0.01',
        'duration_days' => 'required|integer|min:1',
    ]);

    DB::beginTransaction();

    try {
        $user = auth()->user();
        $invested_amount = $request->hashrate * $request->price_per_ths;

        if ($user->wallet < $invested_amount) {
            return redirect()->back()->with('error', 'Insufficient wallet balance.');
        }

        // Deduct from user wallet
        $user->wallet -= $invested_amount;
        $user->save();

        // ROI logic
        $roi_percentage = 1; // 1% daily profit
        $duration = (int) $request->duration_days;
        $daily_profit = $invested_amount * ($roi_percentage / 100);
        $total_profit = $daily_profit * $duration;
        $return_amount = $invested_amount + $total_profit;

        // Dates
        $startDate = now();
        $endDate = now()->addDays($duration);

        // Save mining purchase
        $mining = new MiningPurchase([
            'crypto_type' => $request->crypto_type,
            'hashrate' => $request->hashrate,
            'price_per_ths' => $request->price_per_ths,
            'total_price' => $invested_amount,
            'user_id' => $user->id,
            'duration_days' => $duration,
            'expected_profit' => $total_profit,
            'status' => 'pending',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'completed_at' => null,
            'profit_paid_at' => null,
        ]);

        $mining->save();

        DB::commit();

        return redirect()->route('mining.purchase.confirm')->with([
            'crypto_type' => $request->crypto_type,
            'invested_amount' => $invested_amount,
            'roi_percentage' => $roi_percentage,
            'daily_profit' => $daily_profit,
            'total_profit' => $total_profit,
            'return_amount' => $return_amount,
            'duration' => $duration,
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error purchasing mining power: ' . $e->getMessage());

        return redirect()->back()->with('error', 'An error occurred while processing your request.');
    }
}

public function miningHistory()
{
    $user = auth()->user();
    
    // Fetch mining purchase records for the user
    $purchases = MiningPurchase::where('user_id', $user->id)->get();
    
    // Calculate the total paid profit
    $totalPaidProfit = MiningProfit::where('user_id', $user->id)
        ->where('status', 'paid')
        ->sum('profit_amount');
    
    return view('user.mining.history', compact('purchases', 'totalPaidProfit'));
}


    public function getLivePrices()
    {
        $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
            'ids' => 'bitcoin,ethereum',
            'vs_currencies' => 'usd',
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Unable to fetch prices'], 500);
        }
    }
}
