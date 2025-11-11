@extends('user.layouts.main')

@section('content')

<div class="section section--head">
    <div class="container">
        <div class="row">
            <!-- title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h1>Deposit History</h1>
                    <p>Deposit transaction history</p>
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
                       <table class="deals__table">
                                <thead>
                                    <tr>
                                        <th>Crypto Type</th>
                <th>Sent Address:</th>
                <th>Amount ($)</th>
                <th>Crypto Amount</th>
                <th>Status</th>
                <th>User Confirm</th>
                <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse($deposits as $deposit)
                                        <tr>
                                            <td>
                                                <div class="deals__text">{{ $deposit->crypto_type }}</div>
                                            </td>
                                            <td>
                                                <div class="deals__exchange">
                                                    <span class="green">{{ $deposit->wallet_address }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy"><i class="ti ti-currency-dollar"></i>{{ number_format($deposit->amount, 2) }}</div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">{{ $deposit->crypto_amount }}</div>
                                            </td>
                                            
                                             <td>
                                                @if($deposit->status === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">{{ $deposit->user_confirm ? 'Yes' : 'No' }}</div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">{{ $deposit->created_at->format('d M Y, h:i A') }}</div>
                                            </td>
                                           
                                        </tr>
                                         @empty
                <tr>
                    <td colspan="7">No deposits yet.</td>
                </tr>
            @endforelse
                                   
                                </tbody>
                            </table>
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