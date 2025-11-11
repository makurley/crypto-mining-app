<?php
namespace App\Http\Controllers;

use App\Models\MiningProfit;
use App\Models\User;
use Illuminate\Http\Request;

class UserMiningController extends Controller
{
  public function index()
    {
        // Get the user's mining purchases
        $purchases = MiningPurchase::where('user_id', auth()->id())->get();

        // Calculate the total paid profit for this user
        $totalPaidProfit = MiningProfit::where('user_id', auth()->id())
                                       ->where('status', 'paid')
                                       ->sum('profit_amount');

        // Return view with purchases and total paid profit
        return view('user.mining.history', compact('purchases', 'totalPaidProfit'));
    }

    
    public function calculateProfit()
{
    // Example calculation, replace with your actual logic
    if ($this->status == 'paid') {
        // Assuming `total_price` is the amount invested
        $this->profit_amount = $this->total_price * 0.1;  // Example: 10% profit
    }
}
 public function withdrawProfit(Request $request)
{
    $user = auth()->user();
    
    // Get the total paid profit from the form submission
    $totalPaidProfit = $request->input('total_paid_profit');

    // Check if the user has enough profit to withdraw
    if ($totalPaidProfit <= 0) {
        return redirect()->route('user.mining.history')->with('error', 'No profit to withdraw.');
    }

    // Subtract the total paid profit from the 'MiningProfit' table where the status is 'paid'
    $profits = MiningProfit::where('user_id', $user->id)
                           ->where('status', 'paid')
                           ->orderBy('created_at', 'asc')  // Adjust based on how you want to deduct profits
                           ->get();

    $profitRemaining = $totalPaidProfit;

    foreach ($profits as $profit) {
        // Check if there's enough profit to deduct from this record
        if ($profit->profit_amount >= $profitRemaining) {
            // Deduct the remaining profit
            $profit->profit_amount -= $profitRemaining;
            $profit->save();

            // Add to the user's wallet
            $user->wallet += $profitRemaining;
            $user->save();

            // Mark the profit as withdrawn
            $profit->status = 'withdrawn';
            $profit->save();

            // After processing, stop further deduction
            break;
        } else {
            // Deduct the entire profit amount from this record and move to the next
            $profitRemaining -= $profit->profit_amount;
            $user->wallet += $profit->profit_amount;
            $user->save();

            // Mark the profit as withdrawn
            $profit->status = 'withdrawn';
            $profit->save();
        }
    }

    // Check if there's still remaining profit to withdraw
    if ($profitRemaining > 0) {
        return redirect()->route('mining.history')->with('error', 'Not enough profit to withdraw.');
    }

    return redirect()->route('mining.history')->with('success', 'Profit withdrawn successfully!');
}
public function checkServerStatus()
{
    return response()->json([
        'server_status' => config('mining.status', 0), // Example logic
    ]);


}
}
