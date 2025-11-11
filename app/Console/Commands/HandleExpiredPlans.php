<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HandleExpiredPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:handle-expired-plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
   public function handle()
{
    $expiredPlans = UserPlan::where('status', 'active')
        ->where('expires_at', '<=', now())
        ->get();

    foreach ($expiredPlans as $plan) {
        $user = $plan->user;
        $totalReturn = $plan->price + $plan->expected_profit;

        $user->wallet += $totalReturn;
        $user->save();

        $plan->status = 'completed';
        $plan->save();

        Payout::create([
            'user_id' => $user->id,
            'user_plan_id' => $plan->id,
            'amount' => $totalReturn,
        ]);

        \Log::info("Payout completed for user {$user->id}: Plan ID {$plan->id}, Amount {$totalReturn}");

        // Send email
        \Mail::to($user->email)->send(new \App\Mail\PayoutSuccessMail($plan, $totalReturn));
    }

    $this->info('Expired plans processed successfully.');
}

}
