@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Fund Wallet for {{ $user->email }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.fund.wallet.post') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="form-group">
            <label for="amount">Amount (₦):</label>
            <input type="number" name="amount" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Fund Wallet</button>
    </form>
</div>
@endsection
