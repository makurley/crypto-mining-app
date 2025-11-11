@extends('user.layouts.main')

@section('content')
<br><br><br><br><br>

<section class="section">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h2>Refeeral Bonus</h2>
                    <p>Bonus Withdrawal History</p>
                </div>
            </div>
            <!-- End Title -->

            <!-- Total Paid Profit Section -->
       <!-- Total Paid Profit Section -->
            <!-- End Total Paid Profit -->

            <!-- Deals Table -->
            <div class="col-12">
                <div class="deals">
                    <div class="deals__table-wrap">
  @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($history->isEmpty())
        <p>No referral bonus history available.</p>
    @else
                            <table class="deals__table">
                                <thead>
                                 <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $index => $history)
                        <tr>
                            <td> <div class="deals__text deals__text--buy">{{ $index + 1 }}</div></td>
                            <td> <div class="deals__text deals__text--buy">{{ $history->description }}</div></td>
                            <td> <div class="deals__text deals__text--buy">${{ number_format($history->amount, 2) }}</div></td>
                            <td> <div class="deals__text deals__text--buy">{{ $history->created_at->format('d M, Y h:i A') }}</div></td>
                        </tr>
                    @endforeach
                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
            <!-- End Deals Table -->


        </div>
    </div>
</section>

@endsection
