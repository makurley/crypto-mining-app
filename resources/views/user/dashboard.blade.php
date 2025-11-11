
@extends('user.layouts.main')
@section('title', 'Dashboard')
@section('content')


	<!-- head -->
	<div class="section section--head">
		<div class="container">
	        {{-- Email verification alert --}}
    @if (Auth::check() && !Auth::user()->hasVerifiedEmail())
    <div class="alert alert-warning text-center">
        Your email is not verified.
        <form method="POST" action="{{ route('verification.send') }}" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-warning">
                {{ session('message') ? 'Resend Verification Link' : 'Send Verification Link' }}
            </button>
        </form>
        @if (session('message'))
            <div class="alert alert-success mt-3 mb-0">
                {{ session('message') }}
            </div>
        @endif
    </div>
@endif
           
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<div class="section__title">
						<h1>Control Panel</h1>
					@if (Auth::check())
    <p>Welcome {{ Auth::user()->username }}</p>
@else
@endif
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<!-- end head -->

	<!-- profile -->
	<div class="section">
		<div class="container">
			<div class="row">
				<!-- tabs nav -->
				<div class="col-12 col-lg-3">
					<div class="section__tabs-profile">
						<ul class="nav nav-tabs section__tabs section__tabs--big section__tabs--profile" id="section__tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">Dashboard</button>
							</li>

							<li class="nav-item" role="presentation">
								<button data-bs-toggle="tab" data-bs-target="#tab-2" type="button" role="tab" aria-controls="tab-2" aria-selected="false">KYC</button>
							</li>

							<li class="nav-item" role="presentation">
								<button data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab" aria-controls="tab-3" aria-selected="false">Deposit</button>
							</li>

							<li class="nav-item" role="presentation">
								<button data-bs-toggle="tab" data-bs-target="#tab-4" type="button" role="tab" aria-controls="tab-4" aria-selected="false">Withdraw</button>
							</li>

							<li class="nav-item" role="presentation">
								<button data-bs-toggle="tab" data-bs-target="#tab-5" type="button" role="tab" aria-controls="tab-5" aria-selected="false">Settings</button>
							</li>
							
						
						</ul>

						<!-- design elements -->
						<span class="screw screw--big-br screw--tablet"></span>
						<span class="screw screw--big-bl screw--tablet"></span>
						<span class="screw screw--big-tr screw--tablet"></span>
						<span class="screw screw--big-tl screw--tablet"></span>
					</div>
				</div>
				<!-- end tabs nav -->

				<!-- tabs content -->
				<div class="col-12 col-lg-9">
					<div class="tab-content">
						<!-- dashboard -->
						<div class="tab-pane fade show active" id="tab-1" role="tabpanel">
							<div class="row">
								<div class="col-12 col-md-4">
									<!-- stats -->
									<div class="stats">@if (Auth::check())
										<span class="stats__value">${{ number_format(Auth::user()->wallet, 2) }}
</span>
@endif
										<p class="stats__name">Wallet</p>

										<!-- design elements -->
										<span class="stats__dodger stats__dodger--left stats__dodger--orange"></span>
										<span class="stats__dodger stats__dodger--right stats__dodger--orange"></span>
									</div>
									<!-- end stats -->
								</div>

								<div class="col-12 col-md-4">
									<!-- stats -->
									<div class="stats">
										<span class="stats__value">{{ number_format($totalDeposit, 2) }} </span>
										<p class="stats__name">Deposit amount</p>

										<!-- design elements -->
										<span class="stats__dodger stats__dodger--left stats__dodger--green"></span>
										<span class="stats__dodger stats__dodger--right stats__dodger--green"></span>
									</div>
									<!-- end stats -->
								</div>

								<div class="col-12 col-md-4">
									<!-- stats -->
									<div class="stats">
										<span class="stats__value">${{ number_format($totalProfit, 2) }}</span>
										<p class="stats__name">Earned Profits</p>

										<!-- design elements -->
										<span class="stats__dodger stats__dodger--left stats__dodger--blue"></span>
										<span class="stats__dodger stats__dodger--right stats__dodger--blue"></span>
									</div>
									<!-- end stats -->
								</div>
								
							<div class="col-12">
    <!-- Mining Profitability Chart -->
    <div class="invest invest--big">
        <h5 class="profile__title profile__title--mt">Mining Profitability</h5>

        <canvas id="profitChart" height="120"></canvas>

        @push('scripts')
        <!-- Chart.js & Data Labels -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            let profitChart;
            const ctx = document.getElementById('profitChart').getContext('2d');

            function fetchProfitability() {
                fetch("/api/mining-profitability")
                    .then(res => res.json())
                    .then(data => {
                        const labels = data.map(coin => coin.symbol);
                        const values = data.map(coin => coin.revenue_usd_per_day);

                        if (!profitChart) {
                            profitChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Daily Revenue ($)',
                                        data: values,
                                        fill: true,
                                        tension: 0.4,
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        pointBackgroundColor: '#fff',
                                        pointBorderColor: '#8a21e2',
                                        borderWidth: 2,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'top',
                                            labels: {
                                                color: '#333',
                                                font: { weight: 'bold' }
                                            }
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: ctx => `$${ctx.parsed.y.toFixed(6)}`
                                            }
                                        },
                                        datalabels: {
                                            anchor: 'end',
                                            align: 'top',
                                            color: '#d6d4d4',
                                            formatter: val => `$${val}`
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                callback: value => `$${value}`
                                            }
                                        }
                                    }
                                },
                                plugins: [ChartDataLabels]
                            });
                        } else {
                            profitChart.data.labels = labels;
                            profitChart.data.datasets[0].data = values;
                            profitChart.update();
                        }
                    });
            }

            fetchProfitability();
            setInterval(fetchProfitability, 10000); // Auto-refresh every 10s
        });
        </script>
        @endpush

        <!-- Decorative elements -->
        <span class="block-icon block-icon--green">
            <i class="ti ti-trending-up"></i>
        </span>
        <span class="screw screw--lines-bl"></span>
        <span class="screw screw--lines-br"></span>
        <span class="screw screw--lines-tr"></span>
    </div>
</div>


								<div class="col-12">
									<!-- profile -->
									<div class="profile">
										<div class="row">
											<div class="col-12">
										<h3 class="profile__title profile__title--mt">Start Mining</h3>
											</div>
											 <div id="responseMessage" class="mt-3"></div>
											<form id="miningForm" method="POST" action="{{ route('mining.store') }}">
    @csrf
    <div class="row">
        <div class="col-12 col-xl-4">
            <div class="form__group">
                <label for="crypto_type" class="form__label">Crypto Type</label>
                <select name="crypto_type" id="crypto_type" class="form__select" required>
                    <option value="bitcoin">Bitcoin</option>
                    <option value="ethereum">Ethereum</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="form__group">
                <label for="hashrate" class="form__label">Hashrate (TH/s)</label>
                <input type="number" name="hashrate" id="hashrate" class="form__input" required min="1" step="0.01">
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="form__group">
                <label for="price_per_ths" class="form__label">Cost per TH/s ($)</label>
                <input type="number" name="price_per_ths" id="price_per_ths" class="apool__input" required min="0.01" step="0.01">
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="form__group">
                <label for="duration_days" class="form__label">Duration (in days)</label>
                <select name="duration_days" id="duration_days" class="form__select" required>
                      <option>Select duration</option>
                        <option value="30">30 Days</option>
                    <option value="60">60 Days</option>
                    <option value="90">90 Days</option>
                    <option value="180">180 Days</option>
                </select>
            </div>
        </div>

        <!-- Show selected duration with AJAX -->
        <div class="col-12 col-xl-4">
            <div class="form__group">
                <label class="form__label">Selected Duration:</label>
                <input type="text" id="selectedDuration" class="form__input" disabled>
            </div>
        </div>

        <!-- Power Cost (calculated) -->
        <div class="col-12 col-xl-4">
            <div class="form__group">
                <label class="form__label">Power Cost($0.10 per TH/s daily)</label>
                <input type="text" id="powerCost" class="form__input" disabled>
            </div>
        </div>

        <div class="row mb-3 w-100">
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <small class="card-title">Invested Amount</small>
                        <p class="card-text"><strong>$<span id="investedAmount">0.00</span></strong></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <small class="card-title">Daily Profit (1%)</small>
                        <p class="card-text"><strong>$<span id="dailyProfit">0.00</span></strong></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <small class="card-title">Total Profit</small>
                        <p class="card-text"><strong>$<span id="totalProfit">0.00</span></strong></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <small class="card-title">Total Return</small>
                        <p class="card-text"><strong>$<span id="totalReturn">0.00</span></strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Crypto Value Output -->
        <div class="col-10 col-lg-4 mb-2">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <small class="card-title">Total Return in Crypto</small>
                    <p class="card-text"><strong><span id="cryptoValue">0.0000</span> <span id="cryptoLabel">BTC</span></strong></p>
                </div>
            </div>
        </div>

        <button type="submit" class="form__btn form__btn--small">Purchase</button>
    </div>
</form>

<script>
    let currentRate = { bitcoin: 0, ethereum: 0 };

    function fetchCryptoRates() {
        fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd')
            .then(res => res.json())
            .then(data => {
                currentRate.bitcoin = data.bitcoin.usd;
                currentRate.ethereum = data.ethereum.usd;
                updateCalculation();
            });
    }

    function updateCalculation() {
        const hashrate = parseFloat(document.getElementById('hashrate').value) || 0;
        const price = parseFloat(document.getElementById('price_per_ths').value) || 0;
        const duration = parseInt(document.getElementById('duration_days').value) || 0;
        const cryptoType = document.getElementById('crypto_type').value;
        const roiPercent = 1;

        const invested = hashrate * price;
        const powerCost = hashrate * duration * 0.10;
        const dailyProfit = invested * (roiPercent / 100);
        const totalProfit = dailyProfit * duration;
        const totalReturn = invested + totalProfit + powerCost;

        document.getElementById('investedAmount').innerText = invested.toFixed(2);
        document.getElementById('dailyProfit').innerText = dailyProfit.toFixed(2);
        document.getElementById('totalProfit').innerText = totalProfit.toFixed(2);
        document.getElementById('totalReturn').innerText = totalReturn.toFixed(2);
        document.getElementById('powerCost').value = `$${powerCost.toFixed(2)}`;

        const rate = currentRate[cryptoType];
        const cryptoValue = rate ? (totalReturn / rate).toFixed(6) : "0.0000";
        document.getElementById('cryptoValue').innerText = cryptoValue;
        document.getElementById('cryptoLabel').innerText = cryptoType === 'bitcoin' ? 'BTC' : 'ETH';
    }

    // Update selected duration text
    document.getElementById('duration_days').addEventListener('change', function () {
        document.getElementById('selectedDuration').value = `${this.options[this.selectedIndex].text}`;
        updateCalculation();
    });

    document.getElementById('hashrate').addEventListener('input', updateCalculation);
    document.getElementById('price_per_ths').addEventListener('input', updateCalculation);
    document.getElementById('crypto_type').addEventListener('change', updateCalculation);

    // Initial run
    fetchCryptoRates();
</script>

										</div>

										<!-- design elements -->
										<span class="screw screw--lines-bl"></span>
										<span class="screw screw--lines-br"></span>
										<span class="screw screw--lines-tr"></span>
										<span class="screw screw--lines-tl"></span>
									</div>
									<!-- end profile -->
								</div>

								<div class="col-12">
									<!-- referral -->
									<div class="invest invest--big">
										<h2 class="invest__title">Referral link</h2>
										@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
										<div class="invest__group">
											<input id="partnerlink" type="text" name="partnerlink" class="form__input" value="{{ $referralLink }}">
										</div>

										<p class="invest__text">Your referral bonus is 1%. Open a deposit of $1000 or more to increase your referral bonus to 3%.</p>

										<table class="invest__table">
											<thead>
												<tr>
													<th>Action</th>
													<th>Value</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Total Earned Bonus</td>
													<td>${{ number_format($referralBonus, 2) }}</td>
												</tr>
												<tr>
													<td class="yellow">Total referrals</td>
													<td>{{ $totalReferrals }}</td>
												</tr>
												<tr>
												    <td>Withdraw:</td>
					<td>

@if(Auth::check() && Auth::user()->ref_bonus > 0)
    <form action="{{ route('referral.withdraw') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Withdraw Bonus</button>
    </form>
@endif</td></tr>
											</tbody>
										</table>

										<!-- design elements -->
										<span class="block-icon block-icon--yellow">
											<i class="ti ti-user-plus"></i>
										</span>
										<span class="screw screw--lines-bl"></span>
										<span class="screw screw--lines-br"></span>
										<span class="screw screw--lines-tr"></span>
									</div>
									<!-- end referral -->
								</div>
							</div>
						</div>
						<!-- end dashboard -->

						<!-- investing -->
						<div class="tab-pane fade" id="tab-2" role="tabpanel">
							<div class="row">
								<div class="col-12">
									<!-- profile -->
									<div class="profile">

										<!-- tabs content -->
										<div class="tab-content">
											<!-- active -->
											<div class="tab-pane fade show active" id="tab-f1" role="tabpanel">
												<div class="row">
												<div class="col-12">
    @if (auth()->user()->kyc_status === 'approved')
        <div class="alert alert-success">
            <p class="text-green-600 font-semibold text-center"><span><small>✅ Your KYC has been approved.</small></span></p>
        </div>
    @elseif (auth()->user()->kyc_status === 'pending')
        <div class="alert alert-info">
            <p class="text-yellow-600 font-semibold text-center"><span><small>Your KYC is under review.</small></span></p>
        </div>
    @elseif (auth()->user()->kyc_status === 'rejected')
        <div class="alert alert-danger">
         <p class="text-red-600 font-semibold text-center"><span><small>❌ Rejected: {{ auth()->user()->kyc_rejection_reason }} </small></span></p> 
         </div>
         
    @elseif (auth()->user()->kyc_status === null)
        <div class="alert alert-danger">
            <p class="font-semibold text-center"><span><small>Your KYC is pending submission.</small></span></p>
        </div>
    @endif

    {{-- Show form only if KYC status is not approved or pending --}}
    @if (auth()->user()->kyc_status !== 'approved' && auth()->user()->kyc_status !== 'pending')
        <!-- deposit -->
        <div class="deposit">
            <div class="deposit__name">
                <h3 class="deposit__title">KYC Verification</h3>
            </div>

            <form action="{{ route('user.kyc.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mt-4">
                @csrf
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="form__group">
                            <label class="form__label" for="kyc_document_type">Document Type</label>
                            <select name="kyc_document_type" id="kyc_document_type" class="form__select" required>
                                <option value="">-- Select Document Type --</option>
                                <option value="passport">Passport</option>
                                <option value="driver_license">Driver’s License</option>
                                <option value="national_id">National ID</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6">
                        <div class="form__group">
                            <label class="form__label" for="kyc_document">Upload Document</label>
                            <input type="file" name="kyc_document" id="kyc_document" class="form__input" accept="image/*,application/pdf" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="form__btn form__btn--small" type="submit">Submit For Verification</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>

												</div>
											</div>
											<!-- active -->
											<!-- end new -->
										</div>
										<!-- end tabs content -->
										
										<!-- design elements -->
										<span class="screw screw--lines-bl"></span>
										<span class="screw screw--lines-br"></span>
										<span class="screw screw--lines-tr"></span>
										<span class="screw screw--lines-tl"></span>
									</div>
									<!-- end profile -->
								</div>
							</div>
						</div>
						<!-- end investing -->

						<!-- deposit -->
						<div class="tab-pane fade" id="tab-3" role="tabpanel">
							<div class="row">
								<div class="col-12">
									<!-- profile -->
									<div class="profile">
										<!-- tabs nav -->
										<ul class="nav nav-tabs section__tabs section__tabs--left" id="section__profile-tabs2" role="tablist">
											<li class="nav-item" role="presentation">
												<button class="active" data-bs-toggle="tab" data-bs-target="#tab-f4" type="button" role="tab" aria-controls="tab-f4" aria-selected="true">Deposit</button>
											</li>
										</ul>
										<!-- end tabs nav -->

										<!-- tabs content -->
										<div class="tab-content">
											<!-- crypto -->
											<div class="tab-pane fade show active" id="tab-f4" role="tabpanel">
											<div class="row">
													<div class="col-12">
														<h3 class="profile__title">Make a deposit</h3>
													</div>
                                     {{-- Notification Messages --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('user.deposit.store') }}" method="POST">
    @csrf
    <div class="row"> <!-- Added a row to contain the columns -->
        <div class="col-12 col-xl-6">
            <div class="form__group">
                <label for="crypto_type" class="form__label">Payment Method</label>
               <select name="crypto_type" id="crypto_type" class="form__select" required>
    <option value="" disabled selected>Select a cryptocurrency</option>
    <option value="bitcoin">Bitcoin</option>
    <option value="ethereum">Ethereum</option>
    <option value="usdt">USDT</option>
</select>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="form__group">
                <label for="amount" class="form__label">Amount in USD:</label>
                <input type="number" name="amount" step="0.01" class="apool__input" required>
            </div>
        </div>

        <div class="col-12">
            <button class="form__btn form__btn--small" type="submit">Deposit</button>
        </div>
    </div>
</form>

												
													
												</div>
											</div>
											<!-- crypto -->
											</div>
											<!-- end epay -->
										</div>
										<!-- end tabs content -->
										
										<!-- design elements -->
										<span class="screw screw--lines-bl"></span>
										<span class="screw screw--lines-br"></span>
										<span class="screw screw--lines-tr"></span>
										<span class="screw screw--lines-tl"></span>
									</div>
									<!-- end profile -->
								</div>
							</div>
						
						<!-- end deposit -->

						<!-- withdraw -->
						
					<div class="tab-pane fade" id="tab-4" role="tabpanel">
    <div class="row">
        <div class="col-12">
            <div class="profile">
                <ul class="nav nav-tabs section__tabs section__tabs--left" id="section__profile-tabs2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#tab-f6" type="button" role="tab" aria-controls="tab-f4" aria-selected="true">Withdraw</button>
                    </li>
                </ul>
	<div class="tab-content">
                <div class="tab-pane fade show active" id="tab-f6" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="profile__title profile__title--mt">Withdraw</h3>
                        </div>

                        <form action="{{ route('user.withdraw.store') }}" method="POST" class="row">
                            @csrf

                            <div class="col-12 col-xl-6">
                                <div class="form__group">
                                    <label for="wallet_type" class="form__label">Payment method</label>
                                    <select name="wallet_type" id="wallet_type" class="form__select" required>
                                        <option value="" disabled selected>Select wallet type</option>
                                        @foreach($wallets as $wallet)
                                            <option value="{{ $wallet->wallet_type }}">{{ ucfirst($wallet->wallet_type) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-xl-6">
                                <div class="form__group">
                                    <label for="amount" class="form__label">Enter amount</label>
                                    <input type="number" name="amount" id="amount" step="0.01" class="apool__input" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form__group">
                                    <label for="wallet_address" class="form__label">Your Wallet Address</label>
                                    <input type="text" id="wallet_address" name="wallet_address" class="form__input" readonly>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="form__btn form__btn--small" type="submit">Next</button>
                            </div>
                        </form>
                    </div>
                    <script>
                        // Update the wallet address field automatically based on selection
                        document.getElementById('wallet_type').addEventListener('change', function () {
                            let wallets = @json($wallets);
                            let selectedType = this.value;
                            let wallet = wallets.find(w => w.wallet_type === selectedType);
                            document.getElementById('wallet_address').value = wallet ? wallet.wallet_address : '';
                        });
                    </script>
                </div>

            </div>
        </div>
        
                <span class="screw screw--lines-bl"></span>
                <span class="screw screw--lines-br"></span>
                <span class="screw screw--lines-tr"></span>
                <span class="screw screw--lines-tl"></span>
    </div>
    	<!-- end profile -->
</div>
</div>							
							
						
						<!-- end withdraw -->
						
			<!-- settings -->
						<div class="tab-pane fade" id="tab-5" role="tabpanel">
							<div class="row">
								<div class="col-12">
									<!-- profile -->
									<div class="profile">
										<!-- tabs nav -->
										<ul class="nav nav-tabs section__tabs section__tabs--left" id="section__profile-tabs3" role="tablist">
											<li class="nav-item" role="presentation">
												<button class="active" data-bs-toggle="tab" data-bs-target="#tab-f8" type="button" role="tab" aria-controls="tab-f8" aria-selected="true">Profile</button>
											</li>

											<li class="nav-item" role="presentation">
												<button data-bs-toggle="tab" data-bs-target="#tab-f9" type="button" role="tab" aria-controls="tab-f9" aria-selected="false">Wallets</button>
											</li>

											<li class="nav-item" role="presentation">
												<button data-bs-toggle="tab" data-bs-target="#tab-f10" type="button" role="tab" aria-controls="tab-f10" aria-selected="false">Password</button>
											</li>
										</ul>
										<!-- end tabs nav -->

										<!-- tabs content -->
									<div class="tab-content">
    <!-- profile -->
<div class="tab-pane fade show active" id="tab-f8" role="tabpanel">
    <div class="row">
        <div class="col-12">
            <h3 class="profile__title">Personal Information</h3>
        </div>

        <!-- Success and Error Messages -->
       <div id="successMessage" class="d-none mt-3"></div>

<div id="errorMessage" class="d-none mt-3">
    <ul id="errorList" class="mb-0"></ul>
</div>
        <form id="profileUpdateForm" action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">@if (Auth::check())
                <div class="col-12 col-xl-12">
                    <div class="form__group">
                        <label for="name1" class="form__label">Name</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form__input" required>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="form__group">
                        <label for="username" class="form__label">Username</label>
                        <input type="text" name="username" value="{{ Auth::user()->username }}" class="form__input" required>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="form__group">
                        <label for="email" class="form__label">Email</label>
                        <input type="email" name="email"  value="{{ Auth::user()->email }}" class="form__input" required>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="form__group">
                        <label for="address" class="form__label">Address</label>
                        <input type="text" name="address"  value="{{ old('address', Auth::user()->address) }}" class="form__input" required>
                    </div>
                </div>
                
                <div class="col-12 col-xl-6">
                    <div class="form__group">
                            <label for="address" class="form__label">Country</label>
				<input id="country_selector" name="country" class="form__input" value="{{ old('country', Auth::user()->country) }}" type="text" required>
			</div>
                </div>
                
                <div class="col-12">
                    <button type="button" class="form__btn form__btn w-100" id="submitBtn">Update Profile</button>
                </div>
            </div>
@endif </form>
    </div>
</div>

<!-- AJAX Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#submitBtn').click(function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = $('#profileUpdateForm').serialize();

        $.ajax({
            url: $('#profileUpdateForm').attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#successMessage')
                        .html(response.message)
                        .show()
                        .removeClass('d-none')
                        .addClass('alert alert-success');

                    $('#errorMessage').hide();

                    // Auto-hide after 3 seconds
                    setTimeout(() => {
                        $('#successMessage').fadeOut();
                    }, 2000);
                } else {
                    $('#errorList').html('');
                    $.each(response.errors, function(index, error) {
                        $('#errorList').append('<li>' + error + '</li>');
                    });

                    $('#errorMessage')
                        .show()
                        .removeClass('d-none')
                        .addClass('alert alert-danger');

                    $('#successMessage').hide();

                    // Auto-hide after 3 seconds
                    setTimeout(() => {
                        $('#errorMessage').fadeOut();
                    }, 2000);
                }
            },
            error: function(xhr, status, error) {
                $('#errorMessage')
                    .html('An error occurred. Please try again.')
                    .show()
                    .removeClass('d-none')
                    .addClass('alert alert-danger');

                $('#successMessage').hide();

                // Auto-hide after 3 seconds
                setTimeout(() => {
                    $('#errorMessage').fadeOut();
                }, 2000);
            }
        });
    });
});
</script>


    <!-- end profile -->

    <!-- wallets -->
    <div class="tab-pane fade" id="tab-f9" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <h3 class="profile__title">Your wallets</h3>
            </div>
  
<div class="row">
    <div class="col-12">
         @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </div>
<div id="walletUpdateMessage" class="alert d-none mt-3"></div>
 <form id="updateCryptoWalletsForm" action="{{ route('user.crypto.wallets.update') }}" method="POST" class="col-12">
 
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="form__group">
                    <label class="form__label">BTC Wallet</label>
                    <input type="text" name="btc" class="form__input"
                           value="{{ old('btc', $cryptoWallets['btc'] ?? '') }}">
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <div class="form__group">
                    <label class="form__label">ETH Wallet</label>
                    <input type="text" name="eth" class="form__input"
                           value="{{ old('eth', $cryptoWallets['eth'] ?? '') }}">
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <div class="form__group">
                    <label class="form__label">USDT Wallet</label>
                    <input type="text" name="usdt" class="form__input"
                           value="{{ old('usdt', $cryptoWallets['usdt'] ?? '') }}">
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="form__btn">Update Crypto Wallets</button>
            </div>
        </div>
    </form>
<script>
    $(document).ready(function () {
        $('#updateCryptoWalletsForm').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serialize();
            let messageDiv = $('#walletUpdateMessage');

            // Reset the message box
            messageDiv
                .removeClass('alert-success alert-danger d-none')
                .hide();

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success: function (response) {
                    messageDiv
                        .removeClass('d-none')
                        .addClass('alert alert-success')
                        .text(response.message || 'Wallets updated successfully!')
                        .fadeIn();

                    // Auto-hide after 4 seconds
                    setTimeout(() => {
                        messageDiv.fadeOut();
                    }, 3000);
                },
                error: function (xhr) {
                    let message = 'Something went wrong.';

                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        message = Object.values(errors).flat().join('\n');
                    } else if (xhr.responseJSON?.message) {
                        message = xhr.responseJSON.message;
                    }

                    messageDiv
                        .removeClass('d-none')
                        .addClass('alert alert-danger')
                        .text(message)
                        .fadeIn();

                    // Auto-hide after 4 seconds
                    setTimeout(() => {
                        messageDiv.fadeOut();
                    }, 3000);
                }
            });
        });
    });
</script>



    
</div>





						<!-- end settings -->
					</div>
				</div>
				<!-- password reset-->
			<div class="tab-pane fade" id="tab-f10" role="tabpanel">
    <div class="row">
        <div class="col-12">
            <h3 class="profile__title">Password Reset</h3>
        </div>

        <div class="col-12">
            <div class="alert alert-success" id="successMessage" style="display: none;"></div>
            <div class="alert alert-danger" id="errorMessage" style="display: none;">
                <ul id="errorList"></ul>
            </div>
        </div>

        <div id="password-update-alert" class="col-12"></div>

        <form id="password-update-form" class="col-12">
            @csrf

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form__group">
                        <label for="current_password" class="form__label">Current Password</label>
                        <input type="password" name="current_password" class="form__input" required>
                        <small class="text-danger" id="error-current_password"></small>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form__group">
                        <label for="new_password" class="form__label">New Password</label>
                        <input type="password" name="new_password" class="form__input" required>
                        <small class="text-danger" id="error-new_password"></small>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form__group">
                        <label for="new_password_confirmation" class="form__label">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form__input" required>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="form__btn">Update Password</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Notification script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("password-update-form").addEventListener("submit", function (e) {
            e.preventDefault();

            // Clear previous errors
            document.getElementById("error-current_password").textContent = '';
            document.getElementById("error-new_password").textContent = '';
            document.getElementById("password-update-alert").innerHTML = '';

            const form = e.target;
            const formData = new FormData(form);

            fetch("{{ route('user.update-password') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();

                if (response.ok) {
                    form.reset();
                    document.getElementById("password-update-alert").innerHTML = `
                        <div class="alert alert-success"> {data.message}</div>
                    `;
                } else {
                    if (data.errors) {
                        if (data.errors.current_password) {
                            document.getElementById("error-current_password").textContent = data.errors.current_password[0];
                        }
                        if (data.errors.new_password) {
                            document.getElementById("error-new_password").textContent = data.errors.new_password[0];
                        }
                    } else if (data.message) {
                        document.getElementById("password-update-alert").innerHTML = `
                            <div class="alert alert-danger"> {data.message}</div>
                        `;
                    }
                }
            })
            .catch((error) => {
                console.error("Unexpected Error:", error);
                document.getElementById("password-update-alert").innerHTML = `
                    <div class="alert alert-danger"> Something went wrong. Please try again.</div>
                `;
            });
        });
    });
</script>




						<!-- end settings -->
					</div>
				</div>
				<!-- end tabs content -->
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	</div></div>
	<!-- end profile -->

	@endsection