<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayoutProcessed extends Notification
{
  private $profitHistory;

    public function __construct($profitHistory)
    {
        $this->profitHistory = $profitHistory;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your payout has been processed.')
                    ->line('Amount: ' . $this->profitHistory->payout_amount)
                    ->line('Date: ' . $this->profitHistory->payout_at->toFormattedDateString())
                    ->action('View Your Account', url('/account'))
                    ->line('Thank you for being a valued user!');
    }
    public function processPayouts()
{
    $profitHistories = ProfitHistory::where('payout_status', 'pending')->get();

    foreach ($profitHistories as $profitHistory) {
        // Credit user wallet with the payout amount
        $user = $profitHistory->user;
        $user->wallet += $profitHistory->amount;
        $user->save();

        // Update payout details
        $profitHistory->payout_amount = $profitHistory->amount;
        $profitHistory->payout_at = now();
        $profitHistory->payout_status = 'paid';
        $profitHistory->save();

        // Send email notification
        $user->notify(new PayoutProcessed($profitHistory));

        // Log the payout process
        Log::info("Payout processed for user: {$user->id}, Profit History ID: {$profitHistory->id}");
    }

    return response()->json(['message' => 'Payouts processed successfully']);
}

}
