@extends('user.layouts.main')

@section('content')

<div class="section section--head">
    <div class="container">
        <div class="row">
            <!-- title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h1>Withdrawal History</h1>
                    <p>Withdrawal transaction history</p>
                </div>
            </div>
            <!-- end title -->
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <!-- deals table -->
            <div class="col-12">
                <div class="deals">
                    <div class="deals__table-wrap">
                        @if($withdrawals->count())
                            <table class="deals__table">
                                <thead>
                                    <tr>
                                        <th>Wallet Type</th>
                                        <th>Your Wallet Address</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals as $withdrawal)
                                        <tr>
                                            <td>
                                                <div class="deals__text">{{ ucfirst($withdrawal->wallet_type) }}</div>
                                            </td>
                                            <td>
                                                <div class="deals__exchange">
                                                    <span class="green">{{ $withdrawal->wallet_address }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy"><i class="ti ti-currency-dollar"></i>{{ number_format($withdrawal->amount, 2) }}</div>
                                            </td>
                                            <td>
                                                @if($withdrawal->status === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="deals__text">{{ $withdrawal->created_at->format('d M Y, h:i A') }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No withdrawals found.</p>
                        @endif
                    </div>

                    <!-- design elements -->
                    <span class="screw screw--lines-bl"></span>
                    <span class="screw screw--lines-br"></span>
                    <span class="screw screw--lines-tr"></span>
                    <span class="screw screw--lines-tl"></span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection