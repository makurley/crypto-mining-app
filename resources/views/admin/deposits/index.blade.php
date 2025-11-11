@extends('admin.layouts.master')
@section('title', 'Deposit')
@section('content')
<div class="container">
    <h2 class="mb-4">Crypto Deposits</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Crypto</th>
                <th>Amount (Fiat)</th>
                <th>Crypto Amount</th>
                <th>Wallet Address</th>
                <th>Status</th>
                <th>User Confirm</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deposits as $deposit)
                <tr>
                    <td>{{ $deposit->user->username ?? 'User Deleted' }}</td>
                    <td>{{ $deposit->crypto_type }}</td>
                    <td>${{ number_format($deposit->amount, 2) }}</td>
                    <td>{{ $deposit->crypto_amount }} {{ $deposit->crypto_type }}</td>
                    <td>{{ $deposit->wallet_address }}</td>
                    <td>
                        @if ($deposit->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($deposit->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Unsuccessful</span>
                        @endif
                    </td>
                    <td>{{ $deposit->user_confirm ?? '—' }}</td>
                    <td>
                        @if ($deposit->status === 'pending')
                            <form action="{{ route('admin.deposits.updateStatus', ['id' => $deposit->id, 'status' => 'approved']) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-sm btn-success" onclick="return confirm('Approve this deposit?')">Approve</button>
                            </form>

                            <form action="{{ route('admin.deposits.updateStatus', ['id' => $deposit->id, 'status' => 'unsuccessful']) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Mark as unsuccessful?')">Unsuccessful</button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>Action Taken</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection