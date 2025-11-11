<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\UserPlan;
use App\Models\ProfitHistory;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::with('asset')->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        $assets = Asset::all();
        return view('admin.plans.create', compact('assets'));
    }

    public function store(Request $request)
    {
        // Update validation to require the duration in days
        $request->validate([
             'name' => 'required|string|max:255',
        'hashrate' => 'required|string|max:255',
        'price' => 'required|numeric',
        'asset_id' => 'required|exists:assets,id',
        'duration' => 'required|integer|min:1',
        'roi_type' => 'required|string|max:255',
        'roi_value' => 'required|numeric',
        'expected_profit' => 'required|numeric',
        'badge' => 'nullable|in:popular,recommended,starters',
        'sold_out' => 'nullable|boolean',
        ]);

        $asset = Asset::findOrFail($request->asset_id);

        // Create the plan with the duration in days
        Plan::create([
            'name' => $request->name,
            'hashrate' => $request->hashrate,
            'price' => $request->price,
            'duration' => $request->duration, // Store duration in days
            'roi_type' => $request->roi_type,
            'roi_value' => $request->roi_value,
            'expected_profit' => $request->expected_profit,
            'badge' => $request->badge,
            'asset_id' => $asset->id,
            'power_charge' => $request->power_charge,
            'sold_out' => $request->sold_out ?? 0,
        ]);
   Log::info('Request Data:', $request->all());
        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully');
        

    }
    

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        // Update validation to require the duration in days
        $request->validate([
            'name' => 'required|string|max:255', 
            'hashrate' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1', // duration in days
            'roi_value' => 'required|numeric|min:0',
            'roi_type' => 'required|in:percentage,fixed',
            'expected_profit' => 'required|numeric|min:0',
            'power_charge' => 'required|numeric|min:0',
            'badge' => 'required|in:popular,recommended,starters',
            'sold_out' => 'nullable|boolean',
            
        ]);

        // Update the plan with the form data
        $plan->update([
            'name' => $request->name,
            'hashrate' => $request->hashrate,
            'price' => $request->price,
            'duration' => $request->duration, // Update duration to be stored in days
            'roi_value' => $request->roi_value,
            'roi_type' => $request->roi_type,
            'expected_profit' => $request->expected_profit,
            'badge' => $request->badge,
           'sold_out' => $request->sold_out ?? 0,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully!');
    }
   public function payProfit($userPlanId)
    {
        // Import UserPlan model at the top of this file
        $userPlan = UserPlan::with('user')->findOrFail($userPlanId);

        // Check if the plan is already completed
        if ($userPlan->status === 'completed') {
            return back()->with('error', 'This plan is already paid out.');
        }

        // Create a new profit entry in the profit_histories table
        $profitHistory = ProfitHistory::create([
            'user_id' => $userPlan->user_id,
            'user_plan_id' => $userPlan->id,
            'amount' => $userPlan->expected_profit,
            'payout_amount' => $userPlan->expected_profit,
            'payout_at' => now(),
            'payout_status' => 'Paid',
            'transaction_id' => strtoupper(Str::random(10)), // Unique alphanumeric transaction ID
            'description' => 'Profit Paid',
        ]);

        // Update the user plan status to completed
        $userPlan->update(['status' => 'completed']);

        return back()->with('success', 'Profit paid successfully.');
    }

public function planControl()
{
    $userPlans = UserPlan::with('user', 'plan')->get(); // You can adjust the relations as needed
    return view('admin.plans.plancontrol', compact('userPlans'));
}
public function destroy($id)
{
    // Find the plan by ID or fail
    $plan = Plan::findOrFail($id);

    // Delete the plan
    $plan->delete();

    // Redirect back with a success message
    return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
}
}
