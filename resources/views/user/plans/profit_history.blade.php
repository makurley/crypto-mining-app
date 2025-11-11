@extends('user.layouts.main')

@section('content')
<br><br><br><br><br>

<section class="section">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h2>Profit Ledger</h2>
                    <p>Mining Profit History</p>
                </div>
            </div>
            <!-- End Title -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
            <!-- Deals Table -->
            <div class="col-12">
                <div class="deals">
                    <div class="deals__table-wrap">
                        
                        
@if($profits->isEmpty())
    <p class="text-light text-center">No profit history available.</p>
@else
<div class="text-light text-end mb-3">
    <strong>Total Paid Profit:</strong> ${{ number_format($totalProfit, 2) }}
    <form action="{{ route('user.withdrawProfit') }}" method="POST">
    @csrf
    <br>
    <button type="submit" class="btn btn-success mb-3">
        Withdraw Profit
    </button>
</form>
</div>


   <table class="deals__table">
    <thead>
        <tr>
             <th>Transaction ID</th>
            <th>Plan</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($profits as $profit)
            <tr>
                
                <td>
                    <div class="deals__text deals__text--buy">{{ $profit->transaction_id }}</div>
                </td>
                <td>
                    @if($profit->userPlan && $profit->userPlan->plan)
                        <div class="deals__text deals__text--buy">{{ $profit->userPlan->plan->name }}</div>
                    @else
                        <div class="deals__text deals__text--buy">N/A</div>
                    @endif
                </td>
                <td>
                    <div class="deals__text deals__text--buy">
                        <i class="ti ti-currency-dollar"></i>{{ number_format($profit->amount, 2) }}
                    </div>
                </td>
                <td>
                    <div class="deals__text deals__text--buy">{{ $profit->description }}</div>
                </td>
                <td>
                    <div class="deals__text deals__text--buy">{{ $profit->created_at->format('Y-m-d') }}</div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

                    </div>

                    <!-- Design Elements -->
                    <span class="screw screw--lines-bl"></span>
                    <span class="screw screw--lines-br"></span>
                    <span class="screw screw--lines-tr"></span>
                    <span class="screw screw--lines-tl"></span>
                </div>
            </div>
            <!-- End Deals Table -->

        </div>
    </div>
</section>

@endsection