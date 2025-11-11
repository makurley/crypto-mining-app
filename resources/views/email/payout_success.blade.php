<h2>Hi {{ $plan->user->name }},</h2>
<p>Your mining/investment plan <strong>{{ $plan->plan->name }}</strong> has expired.</p>
<p>Total amount of <strong>${{ number_format($amount, 2) }}</strong> (Capital + Profit) has been credited to your wallet.</p>
<p>Thank you for using our platform!</p>
