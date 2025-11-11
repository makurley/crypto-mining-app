@extends('user.layouts.main')

@section('content')
<br><br><br><br><br>

<section class="section">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h2>Mining History</h2>
                    <p>Mining History</p>
                </div>
            </div>
            <!-- End Title -->

            <!-- Total Paid Profit Section -->
       <!-- Total Paid Profit Section -->
       @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="col-12">
    <div class="deals">
        <div class="deals__text deals__text--buy">
            <!-- Display Total Paid Profit -->
            @if(isset($totalPaidProfit) && $totalPaidProfit > 0)
                <strong>Total Paid Profit: ${{ number_format($totalPaidProfit, 2) }}</strong>
                <br></div>
                <!-- Withdraw Profit Button -->
               <div class="deals__text align-right">
                <form action="{{ route('user.withdraw-profit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total_paid_profit" value="{{ $totalPaidProfit }}">
                    <button type="submit" class="btn btn-primary">Withdraw Profit</button>
                </form>
            @else
                <p>Total Paid Profit: Not Available</p>
            @endif
        </div></div>
    </div>
            <!-- End Total Paid Profit -->

            <!-- Deals Table -->
            <div class="col-12">
                <div class="deals">
                    <div class="deals__table-wrap">

                        @if($purchases->isEmpty())
                            <p class="text-light text-center">No mining purchases yet.</p>
                        @else
                            <table class="deals__table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Crypto</th>
                                        <th>Hashrate (TH/s)</th>
                                        <th>Invested ($)</th>
                                        <th>Duration (days)</th>
                                        <th>Created At</th>
                                        <th>Mining End Date</th>
                                        <th>Status</th>
                                        <th>Expected Profit ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchases as $purchase)
                                        <tr>
                                            <td>
                                                <div class="deals__text deals__text--buy">{{ $loop->iteration }}</div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">{{ $purchase->crypto_type }}</div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">{{ $purchase->hashrate }}</div>
                                            </td>
                                           <td class="crypto-convert" data-usd="{{ $purchase->total_price }}" data-crypto="{{ strtolower($purchase->crypto_type) }}">
    <span class="converted-value text-warning"></span>
</td>
                                            <td>
                                                <div class="deals__text deals__text--buy">{{ $purchase->duration_days }}</div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">{{ $purchase->created_at->format('d M Y') }}</div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">
                                                    @if($purchase->end_date)
                                                        {{ \Carbon\Carbon::parse($purchase->end_date)->format('d M Y') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">
                                                    @if($purchase->end_date && \Carbon\Carbon::parse($purchase->end_date)->isFuture())
                                                        Running
                                                    @else
                                                     Mining Ended
                                                    @endif
                                                </div>
                                            </td>
                                         <td class="crypto-convert" data-usd="{{ $purchase->expected_profit }}" data-crypto="{{ strtolower($purchase->crypto_type) }}">
    @if($purchase->expected_profit)
        <span class="converted-value text-warning"></span>
    @else
        N/A
    @endif
</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
            <!-- End Deals Table -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const cells = document.querySelectorAll('.crypto-convert');
    const cryptoSet = new Set();

    // Map full CoinGecko ID to Symbol
    const cryptoSymbolMap = {
        bitcoin: 'BTC',
        ethereum: 'ETH',
        tether: 'USDT',
        solana: 'SOL',
        dogecoin: 'DOGE',
        binancecoin: 'BNB',
        litecoin: 'LTC',
        usdc: 'USDC'
        // Add more if needed
    };

    cells.forEach(cell => {
        const crypto = cell.dataset.crypto;
        if (crypto) cryptoSet.add(crypto);
    });

    if (cryptoSet.size === 0) return;

    const cryptoList = Array.from(cryptoSet).join(',');
    const apiUrl = `https://api.coingecko.com/api/v3/simple/price?ids=${cryptoList}&vs_currencies=usd`;

    fetch(apiUrl)
        .then(res => res.json())
        .then(data => {
            cells.forEach(cell => {
                const usd = parseFloat(cell.dataset.usd);
                const crypto = cell.dataset.crypto;

                if (usd > 0 && data[crypto] && data[crypto].usd) {
                    const price = data[crypto].usd;
                    const converted = (usd / price).toFixed(6);
                    const symbol = cryptoSymbolMap[crypto] || crypto.toUpperCase(); // fallback
                    cell.querySelector('.converted-value').textContent = `${converted} ${symbol}`;
                }
            });
        })
        .catch(error => {
            console.error("Error fetching crypto prices:", error);
        });
});
</script>

        </div>
    </div>
</section>

@endsection
