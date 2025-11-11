<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ProfitHistory; // Add this line to import the ProfitHistory model
use Carbon\Carbon; 
use App\Models\ReferralSetting;

class PlanController extends Controller
{
    // Display all available plans
     public function index()
    {
        $plans = Plan::with('asset')->get();

        // Add duration in days (approximate as 30 days per month)
        foreach ($plans as $plan) {
            $plan->duration_in_days = $plan->duration * 30;
        }

        return view('user.plans.index', compact('plans'));
    }

    // Display profit history
    public function profitHistory()
    {
        // Retrieve profits from profit_histories table with the related userPlan and plan data
        $profits = ProfitHistory::with('userPlan.plan')->get();  // Change Profit to ProfitHistory

        
    // Calculate total profit
    $totalProfit = ProfitHistory::sum('payout_amount');

    return view('user.plans.profit_history', compact('profits', 'totalProfit'));
    }



    // Handle the logic when a user purchases a plan
public function purchase(Plan $plan)
{
    $user = Auth::user();

    if ($user->wallet < $plan->price) {
        return back()->with('error', 'Insufficient funds');
    }

    $user->wallet -= $plan->price;
    $user->save();

    $expectedProfit = $plan->expected_profit;
    $expiresAt = now()->addDays((int) $plan->duration);

    try {
        UserPlan::create([
            'user_id'         => $user->id,
            'plan_id'         => $plan->id,
            'price'           => $plan->price,
            'expected_profit' => $expectedProfit,
            'roi_type'        => $plan->roi_type,
            'roi_value'       => $plan->roi_value,
            'asset_id'        => $plan->asset_id,
            'status'          => 'active',
            'started_at'      => now(),
            'expires_at'      => $expiresAt,
        ]);

        Log::info('UserPlan created:', ['user_id' => $user->id, 'plan_id' => $plan->id]);

        // ✅ Referral Bonus from settings
        if ($user->referred_by) {
            $referrer = \App\Models\User::find($user->referred_by);
            if ($referrer) {
                $referralSetting = ReferralSetting::first(); // Adjust if you have multiple rows or keys

                $bonusPercent = $referralSetting ? $referralSetting->bonus_amount : 1; // default 1% if null
                $bonus = $plan->price * ($bonusPercent / 100);

                $referrer->ref_bonus += $bonus;
                $referrer->save();

                Log::info('Referral bonus credited', [
                    'referrer_id' => $referrer->id,
                    'bonus' => $bonus,
                    'from_user_id' => $user->id,
                    'bonus_percent' => $bonusPercent
                ]);
            }
        }

    } catch (\Exception $e) {
        Log::error('Error creating UserPlan:', ['error' => $e->getMessage()]);
    }

    return redirect()->route('plans.purchase-confirmation')
        ->with([
            'plan_name' => $plan->name,
            'price' => $plan->price,
            'expected_profit' => $expectedProfit,
            'expires_at' => $expiresAt,
        ]);
}
   public function purchaseConfirmation()
    {
        if (!session()->has('plan_name') || !session()->has('price') || !session()->has('expected_profit') || !session()->has('expires_at')) {
            return redirect()->route('plans.my');
        }

        return view('user.plans.purchase-confirmation');
    }

    // Display the user's active plans
    public function myPlans()
    {
        $userPlans = Auth::user()->userPlans()->with('plan')->get();

        // Add duration in days to each user's plan
        foreach ($userPlans as $userPlan) {
            if ($userPlan->plan) {
                $userPlan->plan->duration_in_days = $userPlan->plan->duration * 30;
            }
        }

    $userId = auth()->id();

    // Get user plans
    $userPlans = UserPlan::with(['user', 'plan'])
        ->where('user_id', $userId)
        ->get();

    // Update status to 'processing' if expired and still active
    foreach ($userPlans as $plan) {
        if (Carbon::now()->greaterThan($plan->expires_at) && $plan->status === 'active') {
            $plan->status = 'processing';
            $plan->save();
        }
    }

    return view('user.plans.my_plans', compact('userPlans'));
    }

   

   public function handleExpiredPlans()
{
    $expiredPlans = UserPlan::where('status', 'active')
        ->where('expires_at', '<=', now()) // Checks if the expiration date is before or equal to the current time
        ->get();

    foreach ($expiredPlans as $userPlan) {
        $user = $userPlan->user;

        // Credit the user's wallet with the expected profit
        $user->wallet += $userPlan->expected_profit;
        $user->save();

        // Mark the plan as completed
        $userPlan->status = 'completed';
        $userPlan->save();

        // Log the profit to the profit_histories table
        $userPlan->profits()->create([
            'user_id' => $user->id,
            'user_plan_id' => $userPlan->id,
            'amount' => $userPlan->expected_profit,
            'credited_at' => now(), // Store the current time as the time of credit
        ]);
    }
}

}
