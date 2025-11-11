<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund User Wallet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Fund User Wallet</h2>

    <!-- Success Notification -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Notification -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.fund.wallet.post') }}">
        @csrf
        <div class="form-group">
            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->email }} (₦{{ number_format($user->wallet, 2) }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="amount">Amount:</label>
            <input type="number" name="amount" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Fund Wallet</button>
    </form>
</div>
</body>
</html>