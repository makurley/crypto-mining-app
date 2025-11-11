<?php

namespace App\Console\Commands;

use App\Models\UserPlan;
use App\Models\Transaction;
use Illuminate\Console\Command;

class ProcessExpiredPlans extends Command
{
    protected $signature = 'plans:process-expired';
    protected $description = 'Process expired plans and add the capital and profit to user wallet';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get all active user plans that have expired
        $expiredPlans = UserPlan::where('status', 'active')
            ->where('expires_at', '<', now())
            ->get();

        foreach ($expiredPlans as $plan) {
            $user = $plan->user;

            // Calculate total return (capital + expected profit)
            $totalReturn = $plan->capital + $plan->expected_profit;

            // Add total return to user's wallet
            $user->wallet += $totalReturn;
            $user->save();

            // Mark the plan as expired
            $plan->update([
                'status' => 'expired',
                'total_earnings' => $totalReturn,
            ]);

            // Create a transaction entry for the earnings
            Transaction::create([
                'user_id' => $user->id,
                'amount' => $totalReturn,
                'type' => 'credit',
                'description' => 'Plan ROI + Capital Return',
            ]);
        }

        $this->info('Expired plans processed.');
    }
}
