@extends('user.layouts.main')

@section('content')

    	<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h1>Mining Racks</h1>
						<p>Choose a cloud mining plan, different hash rate per plan, you can improve dedicated mining profits and Hash</p>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<!-- end head -->

	<!-- about -->
	<div class="section section--pb">
		<div class="container">
			<div class="row row--relative">
				<div class="col-12">
					<div class="about">
						<h2 class="about__title">What is {{ $settings->title }} Pools?</h2>

						<p class="about__text">we offer a range of powerful and flexible Cloud 
						Mining Plans designed for everyone—from crypto newbies to seasoned investors. 
						These plans let you earn daily crypto income without the need to buy hardware, 
						set up mining rigs, or manage electricity and cooling..</p>

						<!-- design elements -->
						<span class="block-icon block-icon--purple">
							<i class="ti ti-topology-star-2"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
				</div>

				<!-- animation background -->
				<div class="section__canvas section__canvas--page section__canvas--first" id="canvas"></div>
			</div>
		</div>
	</div>
	<!-- end about -->

	<!-- arbitrage pools -->
	<div class="section">
		<div class="container">
		<div class="row">
    <!-- Error Notification -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
       <div class="col-12 col-xl-12">
                <div class="form__group">
            <h3 class="profile__title profile__title--mt">Mining pool</h3>
        </div>
<form id="miningForm" method="POST" action="{{ route('mining.store') }}">
        @csrf

        <div class="col-12 col-xl-4">
                <div class="form__group">
            <label for="crypto_type" class="form__label">Crypto Type</label>
            <select name="crypto_type" id="crypto_type" class="apool__input" required>
                <option value="bitcoin">Bitcoin</option>
                <option value="ethereum">Ethereum</option>
            </select>
        </div></div>

        <div class="col-12 col-xl-4">
                <div class="form__group">
            <label for="hashrate"  class="form__label">Hashrate (TH/s)</label>
            <input type="number" name="hashrate" id="hashrate" class="apool__input" required min="1" step="0.01">
        </div></div>

        <div class="col-12 col-xl-4">
                <div class="form__group">
            <label for="price_per_ths" class="form__label">Price per TH/s ($)</label>
            <input type="number" name="price_per_ths" id="price_per_ths" class="apool__input" required min="0.01" step="0.01">
        </div></div>

        <div class="col-12 col-xl-4">
                <div class="form__group">
            <label for="duration_days" class="form-label">Duration (in days)</label>
            <input type="number" name="duration_days" id="duration_days" class="apool__input" required min="1">
        </div></div>

        <hr>

        <h5>ðŸ“Š Live Calculation</h5>
        <div class="mb-2 text-white">Invested Amount: <strong>$<span id="investedAmount">0.00</span></strong></div>
        <div class="mb-2">Daily Profit (1%): <strong>$<span id="dailyProfit">0.00</span></strong></div>
        <div class="mb-2">Total Profit: <strong>$<span id="totalProfit">0.00</span></strong></div>
        <div class="mb-2">Total Return: <strong>$<span id="totalReturn">0.00</span></strong></div>

        <button type="submit" class="form__btn form__btn--small">Purchase</button>
    </form>
<!--        <form id="miningForm" method="POST">-->
<!--            @csrf-->
<!--            <div class="col-12 col-xl-4">-->
<!--                <div class="form__group">-->
<!--                    <label for="tariff0" class="form__label">Crypto Type</label>-->
<!--                    <select name="crypto_type" id="crypto_type" class="form__select">-->
<!--                        <option value="BTC">Bitcoin (BTC)</option>-->
<!--                        <option value="ETH">Ethereum (ETH)</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="col-12 col-xl-4">-->
<!--                <div class="form__group">-->
<!--                    <label for="amount01" class="form__label">Hashrate (TH/s)</label>-->
<!--                    <input type="number" name="hashrate" id="hashrate" class="apool__input" required>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="col-12 col-xl-4">-->
<!--                <div class="form__group">-->
<!--                    <label for="amount01" class="form__label">Price per TH/s ($)</label>-->
<!--                    <input type="number" name="price_per_ths" id="price_per_ths" value="50" class="apool__input" required>-->
<!--                </div>-->
<!--            </div>-->
<!--<div class="col-12 col-xl-4">-->
<!--    <div class="form__group">-->
<!--        <label for="duration_days" class="form__label">Duration (Days)</label>-->
<!--        <input type="number" name="duration_days" id="duration_days" class="apool__input" required>-->
<!--    </div>-->
<!--</div>-->
<!--            <div class="col-12 col-xl-4">-->
<!--                <div class="form__group">-->
<!--                    <label for="amount01" class="form__label">Total Price: $<span id="total_price">0.00</span></label>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12">-->
<!--                <button class="form__btn form__btn--small" type="submit">Purchase</button>-->
<!--            </div>-->
<!--        </form>-->

        <div id="responseMessage" class="mt-3"></div>
    </div>
</div>

<script>
    function updateCalculation() {
        const hashrate = parseFloat(document.getElementById('hashrate').value) || 0;
        const price = parseFloat(document.getElementById('price_per_ths').value) || 0;
        const duration = parseInt(document.getElementById('duration_days').value) || 0;
        const roiPercent = 1;

        const invested = hashrate * price;
        const dailyProfit = invested * (roiPercent / 100);
        const totalProfit = dailyProfit * duration;
        const totalReturn = invested + totalProfit;

        document.getElementById('investedAmount').innerText = invested.toFixed(2);
        document.getElementById('dailyProfit').innerText = dailyProfit.toFixed(2);
        document.getElementById('totalProfit').innerText = totalProfit.toFixed(2);
        document.getElementById('totalReturn').innerText = totalReturn.toFixed(2);
    }

    document.getElementById('hashrate').addEventListener('input', updateCalculation);
    document.getElementById('price_per_ths').addEventListener('input', updateCalculation);
    document.getElementById('duration_days').addEventListener('input', updateCalculation);
</script>



			</div>
		</div>
	</div>
@endsection