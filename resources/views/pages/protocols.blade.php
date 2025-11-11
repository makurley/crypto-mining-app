@extends('layouts.main')
@section('title', 'about')
@section('content')
<!-- head -->
	<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h1>How it works?</h1>
						<p>At {{ $settings->title }}, we simplify the process of earning from cryptocurrency mining. You don’t need to buy expensive hardware or manage complex setups. Our cloud mining system handles everything—so you can focus on profits.</p>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<!-- end head -->

	<!-- steps -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">Create an Account</h3>
						<p class="step__text">Create an account in the system by filling in your login, E-mail and password in the form, verify email and done then login to account.</p>

						<!-- design elements -->
						<span class="block-icon block-icon--orange">
							<i class="ti ti-number-1"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>
					<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">KYC</h3>
						<p class="step__text">Complete KYC verification for authorization on withdrawal and deposit limits</p>

						<!-- design elements -->
						<span class="block-icon block-icon--green">
							<i class="ti ti-number-2"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>
	<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">Update Your Wallet</h3>
						<p class="step__text">Update your preferred cryptocurrency on your profile settings(e.g., BTC, ETH, USDT).</p>

						<!-- design elements -->
						<span class="block-icon block-icon--blue">
							<i class="ti ti-number-3"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>


				<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">Fund Your Wallet</h3>
						<p class="step__text">Deposit funds using your preferred cryptocurrency (e.g., BTC, ETH, USDT). Your balance will appear in your MineWatts wallet and can be used to purchase mining plans.</p>

						<!-- design elements -->
						<span class="block-icon block-icon--orange">
							<i class="ti ti-number-4"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>
	<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">Configure Miner</h3>
						<p class="step__text">On the Dashboard go to Configure Miner Tab and update your Mining Location and Update your IP to match with Miner IP.</p>

						<!-- design elements -->
						<span class="block-icon block-icon--blue">
							<i class="ti ti-number-5"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>

				<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">Choose a Mining Plan</h3>
						<p class="step__text">Browse our flexible cloud mining packages based on:<br>

- Hashrate (TH/s or GH/s)<br>

- Duration (30, 60, 90, or 180 days)<br>

- ROI percentage<br>

- Asset type (Bitcoin, Ethereum, Litecoin, etc.)<br>

- Select a plan that suits your investment goals and budget.</p>

						<!-- design elements -->
						<span class="block-icon block-icon--green">
							<i class="ti ti-number-6"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>

				<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">Start Mining Instantly</h3>
						<p class="step__text">Once a plan is purchased, mining begins automatically. You don’t need to install anything or worry about hardware—our servers do the work for you 24/7.</p>

						<!-- design elements -->
						<span class="block-icon block-icon--yellow">
							<i class="ti ti-number-7"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>

				<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">Track Your Earnings</h3>
						<p class="step__text">Access your real-time mining dashboard to:<br>

- Monitor your active plans<br>

- Track hashrate performance<br>

- View daily earnings and accumulated profit<br>

- Mining payouts are credited to your wallet daily or as per the plan’s conditions.</p>

						<!-- design elements -->
						<span class="block-icon block-icon--purple">
							<i class="ti ti-number-8"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>

				<div class="col-12">
					<!-- step -->
					<div class="step">
						<h3 class="step__title">Withdraw accumulated profits</h3>
						<p class="step__text">You can withdraw your earnings anytime to your crypto wallet (Bitcoin, Ethereum, USDT, etc.) with no delays. Our system supports secure, fast payouts.

</p>

						<!-- design elements -->
						<span class="block-icon block-icon--red">
							<i class="ti ti-number-9"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end step -->
				</div>

				<div class="col-12">
					<!-- section btns -->
					<div class="section__btns">
						<a href="{{ route('register') }}" class="section__btn">Start Now</a>
					</div>
					<!-- end section btns -->
				</div>
			</div>
		</div>
	</div>
	<!-- end steps -->

		@endsection
	