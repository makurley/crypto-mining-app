<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wallet & Transaction History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="mb-4">Wallet Balance: ₦{{ number_format(Auth::user()->wallet_balance, 2) }}</h3>

            <h4 class="mb-3">Transaction History</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                        <td>{{ ucfirst($transaction->type) }}</td>
                        <td>₦{{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ $transaction->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No transactions found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
