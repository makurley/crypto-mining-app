
<?php $__env->startSection('title', 'home'); ?>
<?php $__env->startSection('content'); ?>

	<!-- hero -->
	<section class="hero">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-7">
					<!-- hero first -->
					<div class="hero__content hero__content--first">
						<h1 class="hero__title"><strong><?php echo e($settings->title); ?></strong></h1><h3 class="text-white"><br>Next-generation cloud mining <br>platform. 
						secure, scalable, and simple <br>access to cryptocurrency mining.</h3>
           <p class="text-white"> At <?php echo e($settings->title); ?>, we believe in a decentralized future where anyone, anywhere can earn from cryptocurrency mining without the need for expensive hardware, complicated setups, or technical know-how.
</p>
<!--<img src="<?php echo e(asset('assets/img/ban1.png')); ?>" alt="Miner" class="img-fluid" style="max-width: 300px;">-->
						<div class="hero__btns">
							<a href="<?php echo e(route('register')); ?>" class="hero__btn">Sign Up</a>
							<a href="<?php echo e(route('about')); ?>" class="hero__btn hero__btn--light">About us</a>
						</div>
						
						
					</div>
					<!-- end hero first -->
				</div>

			<div class="col-12 col-lg-5">
	<div class="hero__content hero__content--second">
		<!-- CTA -->
		<div class="cta">
			<h2 class="cta__title">Mining Profit Calculator</h2>
			<p class="cta__text">Estimate your daily profit from crypto mining.</p>
			
			<div class="row">
			<form id="miningCalcForm">
				<div class="form-group mb-2">
					<label class="form__label" for="coin">Select Coin</label>
					<select id="coin" class="form__select">
						<option value="bitcoin">Bitcoin (BTC)</option>
						<option value="ethereum">Ethereum (ETH)</option>
						<option value="tether">Tether (USDT)</option>
					</select>
				</div>

				<div class="form__group">
					<label class="form__label" for="hashrate">Hashrate (TH/s)</label>
					<input type="number" id="hashrate" class="form__input" placeholder="Enter hashrate" min="0.1" step="0.1">
				</div>

				<div class="form-group mb-2">
					<label for="power" class="form__label" >Power Consumption (W)</label>
					<input type="number" id="power" class="form__input" placeholder="Enter power usage" min="0">
				</div>

				<div class="form-group mb-2">
					<label for="cost" class="form__label">Electricity Cost ($/kWh)</label>
					<input type="number" id="cost" class="form__input" placeholder="Enter electricity cost" step="0.01" min="0">
				</div>

				<button type="submit" class="btn btn-primary btn-block mt-2">Calculate</button>
			</form>
			<div id="miningResult" class="mt-3" style="display: none;">
				<h5 class="text-white">Estimated Daily Profit:</h5>
				<p class="text-white"><b><span id="profitUSD"></span> USD</b> / <span id="profitCoin"></span> Coin</p>
			</div>
			</div></div>

			<!-- Result -->
			
		</div>
	</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
	const form = document.getElementById('miningCalcForm');
	const resultDiv = document.getElementById('miningResult');
	const profitUSD = document.getElementById('profitUSD');
	const profitCoin = document.getElementById('profitCoin');

	const coinRewards = {
		bitcoin: 6.25, // Reward per block
		ethereum: 0.003, // Placeholder
		tether: 0.001 // Placeholder
	};

	form.addEventListener('submit', async function(e) {
		e.preventDefault();
		const coin = document.getElementById('coin').value;
		const hashrate = parseFloat(document.getElementById('hashrate').value) || 0;
		const power = parseFloat(document.getElementById('power').value) || 0;
		const cost = parseFloat(document.getElementById('cost').value) || 0;

		const res = await fetch(`https://api.coingecko.com/api/v3/simple/price?ids=${coin}&vs_currencies=usd`);
		const data = await res.json();
		const priceUSD = data[coin].usd;

		// Example simplified formula:
		const rewardPerDay = (hashrate * coinRewards[coin]) / 1000;
		const electricityCost = (power * 24 / 1000) * cost;
		const dailyProfitUSD = (rewardPerDay * priceUSD) - electricityCost;
		const dailyProfitCoin = dailyProfitUSD / priceUSD;

		profitUSD.textContent = dailyProfitUSD.toFixed(2);
		profitCoin.textContent = dailyProfitCoin.toFixed(8);
		resultDiv.style.display = 'block';
	});
});
</script>

			</div>
		</div>
	</section>
	<!-- end hero -->

	<!-- statistics -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6 col-xl-3">
					<!-- stats -->
					<div class="stats">
					 <?php
    use Carbon\Carbon;

    $settings = \App\Models\Setting::first();
    $launchDate = $settings->launch_date;

    // Ensure Carbon parses the date correctly and gets an integer difference
    $daysSinceLaunch = $launchDate ? Carbon::parse($launchDate)->startOfDay()->diffInDays(Carbon::now()->startOfDay()) : 0;
?>

<span class="stats__value"><?php echo e($daysSinceLaunch); ?></strong> <?php echo e($daysSinceLaunch == 1 ? '' : ''); ?></span>
						<p class="stats__name">Days on the market</p>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--purple"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--purple"></span>
					</div>
					<!-- end stats -->
				</div>

				<div class="col-12 col-sm-6 col-xl-3">
					<!-- stats -->
					<div class="stats">
						<span class="stats__value">5812</span>
						<p class="stats__name">Members</p>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--orange"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--orange"></span>
					</div>
					<!-- end stats -->
				</div>

				<div class="col-12 col-sm-6 col-xl-3">
					<!-- stats -->
					<div class="stats">
						<span class="stats__value">$374 103</span>
						<p class="stats__name">Arbitrage pools</p>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--green"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--green"></span>
					</div>
					<!-- end stats -->
				</div>

				<div class="col-12 col-sm-6 col-xl-3">
					<!-- stats -->
					<div class="stats">
						<span class="stats__value">$100 812</span>
						<p class="stats__name">Total paid</p>

						<!-- design elements -->
						<span class="stats__dodger stats__dodger--left stats__dodger--blue"></span>
						<span class="stats__dodger stats__dodger--right stats__dodger--blue"></span>
					</div>
					<!-- end stats -->
				</div>
			</div>
		</div>
	</div>
	<!-- end statistics -->

	<!-- features -->
	<section class="section">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h2>Our features</h2>
						<p>We simplify cryptocurrency mining through cloud technology, allowing users to earn passive income with minimal effort, zero hardware, and full transparency.</p>
					</div>
				</div>
				<!-- end title -->
			</div>

			<div class="row">
				<div class="col-12 col-lg-4">
					<!-- feature -->
					<div class="feature">
						<h3 class="feature__title">Cloud Mining</h3>
						<p class="feature__text">Cloud Mining for Bitcoin, Ethereum, USDT</p>

						<!-- design elements -->
						<span class="block-icon block-icon--orange">
							<i class="ti ti-shield-dollar"></i>
						</span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--big-br"></span>
					</div>
					<!-- end feature -->
				</div>

				<div class="col-12 col-md-6 col-lg-4">
					<!-- feature -->
					<div class="feature">
						<h3 class="feature__title">Automatization</h3>
						<p class="feature__text">Automatic calculations of cloud mining.</p>

						<!-- design elements -->
						<span class="block-icon block-icon--green">
							<i class="ti ti-24-hours"></i>
						</span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--big-br"></span>
					</div>
					<!-- end feature -->
				</div>

				<div class="col-12 col-md-6 col-lg-4">
					<!-- feature -->
					<div class="feature">
						<h3 class="feature__title">Daily profit tracking</h3>
						<p class="feature__text">Real time daily profit tracking</p>

						<!-- design elements -->
						<span class="block-icon block-icon--blue">
							<i class="ti ti-chart-histogram"></i>
						</span>
						<span class="screw screw--bl"></span>
						<span class="screw screw--tr"></span>
						<span class="screw screw--big-br"></span>
					</div>
					<!-- end feature -->
				</div>
			</div>
		</div>
	</section>
	<section class="section">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
					<div class="section__title">
						<h2>Mining deals</h2>
						<p>We offer a range of powerful and flexible Cloud Mining Plans designed for 
						everyone from crypto newbies to seasoned investors. These plans let you earn 
						daily crypto income without the need to buy hardware, set up mining rigs, or manage electricity and cooling.</p>
					</div>
				</div>

				<div class="section">
  
				<div class="col-12">
					<div class="deals">
						<div class="deals__table-wrap">
       

<div class="mb-2 d-flex align-items-center gap-2">
    <label class="deals__text deals__text--buy">Fiat:</label>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="toggleView">
        <label class="deals__text deals__text--buy" for="toggleView">Crypto</label>
    </div>
</div>

<table class="deals__table">
    <thead>
        <tr>
             <th>#</th>
            <th>Plan Name</th>
            <th>Duration</th>
            <th>Asset</th>
            <th>Cost</th>
            <th>Hashrate</th>
            <th>Power Charge</th>
          <th>Interest Profit</th>
            <th>ROI Type</th>
            <th>Net Return</th>
            <th>Badge</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $asset = $plan->asset->name ?? $plan->asset_id;
                $rate = $cryptoRates[$asset] ?? null;

                $priceFiat = $plan->price;
                $priceCrypto = $rate ? $priceFiat / $rate : null;

                $profitFiat = $plan->expected_profit;
                $profitCrypto = $rate ? $profitFiat / $rate : null;
            ?>
            <tr>
                <td><img src="<?php echo e(asset('assets/img/miner.gif')); ?>" alt="Miner" class="img-fluid" style="max-width: 40px;">
</td>
                <td><div class="deals__text deals__text--buy"><b><?php echo e($plan->name); ?></b></div></td>
                <td class=" deals__text deals__text--buy"><?php echo e($plan->duration); ?> day<?php echo e($plan->duration > 1 ? 's' : ''); ?></td>
                <td><div class="deals__text deals__text--buy"><?php echo e($asset); ?></div></td>
                <td>
                    <?php if($rate): ?>
                      <span class=" deals__text deals__text--buy fiat-value">$<?php echo e(number_format($priceFiat, 2)); ?></span>
                        <span class="deals__text deals__text--buy crypto-value d-none">≈ <?php echo e(number_format($priceCrypto, 6)); ?> <?php echo e($asset); ?></span>
                    <?php else: ?>
                        <span style="color: #aaa;">Price Unavailable</span>
                    <?php endif; ?>
                </td>
                <td><div class="deals__text node__title--orange"><b><?php echo e($plan->hashrate); ?></b></div></td> <!-- New Hashrate -->
            <td><div class="deals__text"><?php echo e($plan->power_charge); ?></div></td> <!-- New Power Charge -->

                <td ><div class="deals__text node__title--blue"><b><?php echo e(ucfirst($plan->roi_value)); ?>%</b></div></td>
                <td><div class="deals__text deals__text--buy"><?php echo e(ucfirst($plan->roi_type)); ?></div></td>
                <td>
                    <?php if($rate): ?>
                        <div class="deals__text node__title--green"><b><span class="fiat-value">$<?php echo e(number_format($profitFiat, 2)); ?></span></b></div>
                        <div class="deals__text deals__text--green"><span class="crypto-value d-none"><?php echo e(number_format($profitCrypto, 6)); ?> <?php echo e($asset); ?></span></div>
                    <?php else: ?>
                        <span style="color: #aaa;">Unavailable</span>
                    <?php endif; ?>
                </td>
                <td><div class="deals__text deals__text--buy"><?php echo e($plan->badge ?? 'N/A'); ?></div></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<script>
    document.getElementById('toggleView').addEventListener('change', function () {
        const showCrypto = this.checked;
        document.querySelectorAll('.fiat-value').forEach(el => el.classList.toggle('d-none', showCrypto));
        document.querySelectorAll('.crypto-value').forEach(el => el.classList.toggle('d-none', !showCrypto));
    });
</script>


                    </div>

                    <span class="screw screw--lines-bl"></span>
                    <span class="screw screw--lines-br"></span>
                    <span class="screw screw--lines-tr"></span>
                    <span class="screw screw--lines-tl"></span>
                </div>
            </div>
			</div>
		</div>
		</div>
	</section>

		<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
				<div class="section__title">
						<h2>Our Mining Farms</h2>
						<p>State-of-the-art GPU and ASIC farms powered by green energy and maintained 24/7 by certified engineers. Locations include:.</p>
					</div>
				</div>
	<section class="section">
		<div class="container">
		    <div class="row row--relative">
			    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
				
				</div>
				<div class="col-12 col-lg-6">
					<!-- invest -->
					<div class="invest">
						<h2 class="invest__title">Our Mining Farms</h2>
                    <p class="text-white"></p>
						<ul class="invest__list">
							<li><img src="<?php echo e(asset('assets/img/iceland.png')); ?>" alt="Miner" class="img-fluid" style="max-width: 20px;"> <b>Iceland</b> (cooling efficiency)</li>
							<li><img src="<?php echo e(asset('assets/img/united-states-of-america.png')); ?>" alt="Miner" class="img-fluid" style="max-width: 20px;"> <b>USA</b>  (secure & scalable)</li>
							<li><img src="<?php echo e(asset('assets/img/united-arab-emirates.png')); ?>" alt="Miner" class="img-fluid" style="max-width: 20px;"><b> UAE</b> (solar-powered operation)</li>
							<li><img src="<?php echo e(asset('assets/img/singapore (1).png')); ?>" alt="Miner" class="img-fluid" style="max-width: 20px;"><b> Singapore</b> (Fast fiber-optic backbone)</li>
						</ul>

						<!-- design elements -->
						<span class="block-icon block-icon--orange">
							<i class="ti ti-database-dollar"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end invest -->
				</div>

				<div class="col-12 col-lg-6">
					<!-- invest -->
					<div class="invest">
						<h2 class="invest__title">Tech Features</h2>

						<div class="invest__rate-wrap">
							<div class="invest__rate">
								<span>Uptime SLA</span>
								<p>99.9%</p>
							</div>

							<div class="invest__graph">
								<img src="<?php echo e(asset('assets/img/graph/graph2.svg')); ?>" alt="">
							</div>
						</div>

						<div class="invest__rate-wrap">
							<div class="invest__rate">
								<span>Scrypt algorithm support</span>
								<!-- or .red -->
								<p class="green">SHA-256, Ethash<small></small></p>
								<small class="text-white">Monitored 24/7 with real-time alerts and automated load balancing</small>
							</div>

							<div class="invest__graph">
								<img src="<?php echo e(asset('assets/img/graph/graph1.svg')); ?>" alt="">
							</div>
						</div>

						<!-- design elements -->
						<span class="block-icon block-icon--blue">
							<i class="ti ti-brand-coinbase"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
					<!-- end invest -->
				</div>

				<!-- animation background -->
				<div class="section__canvas section__canvas--first" id="canvas"></div>
			</div>
		</div>
	</section>

	<!-- roadmap -->
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="roadmap">
						<h2 class="roadmap__title">Roadmap</h2>

						<!-- carousel -->
						<div class="roadmap__carousel splide splide--roadmap">
							<div class="splide__arrows">
								<button class="splide__arrow splide__arrow--prev" type="button"><i class="ti ti-arrow-left"></i></button>
								<button class="splide__arrow splide__arrow--next" type="button"><i class="ti ti-arrow-right"></i></button>
							</div>

							<div class="splide__track">
								<ul class="splide__list">
									<li class="splide__slide">
										<!-- step -->
										<div class="roadmap__block roadmap__block--active">
											<h3 class="roadmap__block-title">2023 Q4</h3>
											<ul class="roadmap__block-list">
												<li>Develop the website's backend infrastructure and set up secure trading APIs.</li>
												<li>Design the user interface, ensuring ease of use and seamless navigation.</li>
												<li>Create educational content about cryptocurrency arbitrage trading for the website's Knowledge Center.</li>
											</ul>
										</div>
										<!-- end step -->
									</li>

									<li class="splide__slide">
										<!-- step -->
										<div class="roadmap__block roadmap__block--active">
											<h3 class="roadmap__block-title">2024 Q1</h3>
											<ul class="roadmap__block-list">
												<li>Launch the beta version of the website for a limited user group to gather feedback.</li>
												<li>Test and optimize the trading algorithms to ensure accuracy and efficiency.</li>
												<li>Implement robust security measures, including encryption and two-factor authentication.</li>
											</ul>
										</div>
										<!-- end step -->
									</li>

									<li class="splide__slide">
										<!-- step -->
										<div class="roadmap__block">
											<h3 class="roadmap__block-title">2024 Q2</h3>
											<ul class="roadmap__block-list">
												<li>Launch the full version of the website to the public.</li>
												<li>Implement a comprehensive reporting and analytics system for users to track their trading performance.</li>
												<li>Collaborate with industry experts to provide regular insights and trading tips.</li>
											</ul>
										</div>
										<!-- end step -->
									</li>

									<li class="splide__slide">
										<!-- step -->
										<div class="roadmap__block">
											<h3 class="roadmap__block-title">2024 Q3</h3>
											<ul class="roadmap__block-list">
												<li>Develop advanced trading features, such as arbitrage alerts and strategies.</li>
												<li>Introduce a subscription-based model for premium users, offering exclusive features and resources.</li>
												<li>Expand educational resources with webinars and tutorials.</li>
											</ul>
										</div>
										<!-- end step -->
									</li>

									<li class="splide__slide">
										<!-- step -->
										<div class="roadmap__block">
											<h3 class="roadmap__block-title">2024 Q4</h3>
											<ul class="roadmap__block-list">
												<li>Launch mobile apps for iOS and Android platforms to facilitate trading on the go.</li>
												<li>Continuously update trading algorithms based on market trends and user feedback.</li>
												<li>Collaborate with regulatory experts to ensure compliance with evolving cryptocurrency regulations.</li>
											</ul>
										</div>
										<!-- end step -->
									</li>
								</ul>
							</div>
						</div>
						<!-- end carousel -->


						<!-- design elements -->
						<span class="block-icon block-icon--blue">
							<i class="ti ti-north-star"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end roadmap -->
	
	
	<section class="section">
    <div class="container">
        	<div class="row">
				<!-- title -->
				<div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-8 offset-xl-2">
					<div class="section__title">
					 <h1>News</h1>
                    <p>Stay informed with the latest updates from MineWatts. Explore news about our mining 
                    infrastructure developments, industry insights, cryptocurrency trends, investment opportunities, 
                    promotional offers, token launches, platform updates, and much more—all in one place. </p>	</div>
				</div>
				<!-- end title -->
			</div>
			<div class="section">
    <div class="container">
        <div class="row">
            <!-- post -->
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="post">
                    <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="post__img">
                        <?php if($post->image): ?>
                         <img src="<?php echo e(asset('public/storage/' . $post->image)); ?>">

                        <?php endif; ?>
                    </a>

                    <div class="post__content">
                        <a href="#" class="post__category"><?php echo e($post->category); ?></a>
                        <h3 class="post__title text-white">
                            <a href="<?php echo e(route('blog.show', $post->slug)); ?>"><?php echo e($post->title); ?></a>
                        </h3>
                        <div class="post__meta">
                            <span class="post__date">
                                <i class="ti ti-calendar-up"></i> <?php echo e($post->created_at->format('d.m.y')); ?>

                            </span>
                            <span class="post__views">
                                <i class="ti ti-eye"></i> <?php echo e(rand(10, 100)); ?> <!-- Replace with real views logic if needed -->
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- end post -->
        </div>

  
    </div>
</div>
    </div>
	</section>

	<!-- faq -->
	<section class="section">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-3 col-xl-4 offset-xl-4">
					<div class="section__title">
						<h2>FAQ</h2>
						<p>Here you'll find answers to frequently asked questions about our company and services.</p>
					</div>
				</div>
				<!-- end title -->
			</div>

			<div class="row">
				<!-- tabs nav -->
				<div class="col-12">
					<ul class="nav nav-tabs section__tabs" id="section__tabs" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab" aria-controls="tab-1" aria-selected="true">General</button>
						</li>

						<li class="nav-item" role="presentation">
							<button data-bs-toggle="tab" data-bs-target="#tab-2" type="button" role="tab" aria-controls="tab-2" aria-selected="false">Cloud Mining</button>
						</li>

						<li class="nav-item" role="presentation">
							<button data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab" aria-controls="tab-3" aria-selected="false">Partnership</button>
						</li>

						<li class="nav-item" role="presentation">
							<button data-bs-toggle="tab" data-bs-target="#tab-4" type="button" role="tab" aria-controls="tab-4" aria-selected="false">Payouts</button>
						</li>
					</ul>
				</div>
				<!-- end tabs nav -->

				<!-- tabs content -->
				<div class="col-12">
					<div class="tab-content">
						<div class="tab-pane fade show active" id="tab-1" role="tabpanel">
							<div class="row">
								<!-- accordion -->
								<div class="col-12">
									<div class="accordion" id="accordion">
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">What is cloud mining?</button>

													<div id="collapse1" class="collapse" data-bs-parent="#accordion">
														<p>Cloud mining allows you to mine cryptocurrencies like Bitcoin, Ethereum, 
														and USDT without owning or maintaining physical hardware. Instead, you rent mining power 
														(hashrate) from our secure data centers and receive daily mining rewards based on your plan.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">How does <?php echo e($settings->title); ?> cloud mining work?</button>

													<div id="collapse2" class="collapse" data-bs-parent="#accordion">
														<p>1. Choose a mining plan<br>

2. Make payment using crypto or fiat<br>

3. We allocate real mining power from our farms<br>

4. You receive daily mining rewards directly to your wallet<br>

5. No setup, no noise, no overheating just passive income from day one

.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">Is it safe and legit?</button>

													<div id="collapse3" class="collapse" data-bs-parent="#accordion">
														<p>Yes. We are a fully transparent and compliant platform with:<br>

Verified global mining facilities<br>

Secure, encrypted wallets<br>

Real-time mining dashboards<br>

2FA and anti-fraud monitoring systems</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">When do I start earning?</button>

													<div id="collapse4" class="collapse" data-bs-parent="#accordion">
														<p>You start earning within 24 hours of plan purchase and activation. Your dashboard will update daily with mining profits, and payouts are sent based on your plan and payout schedule.</p>
													</div>
												</div>
											</div>

											<div class="col-12 col-lg-6">
												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">Can I monitor my mining activity?</button>

													<div id="collapse5" class="collapse" data-bs-parent="#accordion">
														<p>Absolutely. We provide:<br>

A real-time mining dashboard<br>

Transaction history logs<br>

Profit tracking by coin and date<br>

Hashrate performance charts</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">Where are your mining farms located?</button>

													<div id="collapse6" class="collapse" data-bs-parent="#accordion">
														<p>Our farms are strategically located in Iceland, USA, Canada, Germany, UAE, Russia Singapore using both renewable and hybrid energy sources.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">Do I need technical knowledge to use this?</button>

													<div id="collapse7" class="collapse" data-bs-parent="#accordion">
														<p>Nope. We handle everything—hardware, software, updates, power, and cooling. All you need to do is select a plan and start earning.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">How do I withdraw my earnings?</button>

													<div id="collapse8" class="collapse" data-bs-parent="#accordion">
														<p>You can withdraw to your

External crypto wallet<br>

Bank account (for fiat-enabled countries)<br>

Or reinvest into new mining plans<br>

Withdrawals are processed within 24–48 hours, depending on network congestion..</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- end accordion -->
							</div>
						</div>

						<div class="tab-pane fade" id="tab-2" role="tabpanel">
							<div class="row">
								<!-- accordion -->
								<div class="col-12">
									<div class="accordion" id="accordion2">
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-1" aria-expanded="false" aria-controls="collapse2-1">How much capital do I need to start?</button>

													<div id="collapse2-1" class="collapse" data-bs-parent="#accordion2">
														<p>The required capital varies depending on your chosen Mining Plan and the cryptocurrency market conditions.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-2" aria-expanded="false" aria-controls="collapse2-2">Can I automate my Mining?</button>

													<div id="collapse2-2" class="collapse" data-bs-parent="#accordion2">
														<p>Yes, our platform offers automated mining features to automate your mining based on your predefined settings.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-3" aria-expanded="false" aria-controls="collapse2-3">What happens when mining difficulty increases?</button>

													<div id="collapse2-3" class="collapse" data-bs-parent="#accordion2">
														<p>Mining difficulty adjusts based on the total number of miners in the network. As difficulty increases:<br>

Your hashrate stays constant<br>

Your daily earnings may slightly decrease<br>
However, we continuously optimize our operations and suggest diversified mining plans to protect your long-term ROI..</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-4" aria-expanded="false" aria-controls="collapse2-4">What happens when my mining contract ends?</button>

													<div id="collapse2-4" class="collapse" data-bs-parent="#accordion2">
														<p>Once your contract ends:<br>

You can reinvest your profits<br>

Withdraw earnings<br>

Or purchase a new plan<br>
We notify you before expiration, and all mining logs and profits remain available in your dashboard.</p>
													</div>
												</div>
											</div>

											<div class="col-12 col-lg-6">
												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-5" aria-expanded="false" aria-controls="collapse2-5">How do you maintain mining hardware?</button>

													<div id="collapse2-5" class="collapse" data-bs-parent="#accordion2">
														<p>We partner with professional data centers that ensure:<br>

Regular hardware maintenance and upgrades<br>

24/7 cooling and ventilation systems<br>

Power redundancy and backup<br>

Real-time monitoring<br>
Our tech team handles everything to maintain optimal performance and uptime.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-6" aria-expanded="false" aria-controls="collapse2-6">Is leverage available on your platform?</button>

													<div id="collapse2-6" class="collapse" data-bs-parent="#accordion2">
														<p>Currently, we do not offer leverage for mining. All purchase are executed with the available funds.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-7" aria-expanded="false" aria-controls="collapse2-7">Can I withdraw my investment at any time?</button>

													<div id="collapse2-7" class="collapse" data-bs-parent="#accordion2">
														<p>Yes, you can withdraw your investment funds at any time, subject to the withdrawal process and any applicable fees.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-8" aria-expanded="false" aria-controls="collapse2-8">Do you provide investment advice?</button>

													<div id="collapse2-8" class="collapse" data-bs-parent="#accordion2">
														<p>While we offer educational resources, we do not provide specific investment advice. It's important to do your own research.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- end accordion -->
							</div>
						</div>

						<div class="tab-pane fade" id="tab-3" role="tabpanel">
							<div class="row">
								<!-- accordion -->
								<div class="col-12">
									<div class="accordion" id="accordion3">
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-1" aria-expanded="false" aria-controls="collapse3-1">Do you offer a referral program?</button>

													<div id="collapse3-1" class="collapse" data-bs-parent="#accordion3">
														<p>Yes, we have a referral program that rewards users for referring new users to our platform.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-2" aria-expanded="false" aria-controls="collapse3-2">Can businesses partner with your platform?</button>

													<div id="collapse3-2" class="collapse" data-bs-parent="#accordion3">
														<p>Yes, we offer partnership opportunities for businesses interested in collaborating with us. Contact our team for more details.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-3" aria-expanded="false" aria-controls="collapse3-3">Is there a requirement for partnership?</button>

													<div id="collapse3-3" class="collapse" data-bs-parent="#accordion3">
														<p>Partnership requirements vary based on the nature of the collaboration. Reach out to us to discuss potential partnerships.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-4" aria-expanded="false" aria-controls="collapse3-4">What benefits do partners receive?</button>

													<div id="collapse3-4" class="collapse" data-bs-parent="#accordion3">
														<p>Partners can access customized solutions, priority support, and potentially earn revenue through our partnership programs.</p>
													</div>
												</div>
											</div>

											<div class="col-12 col-lg-6">
												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-5" aria-expanded="false" aria-controls="collapse3-5">How can I become an affiliate partner?</button>

													<div id="collapse3-5" class="collapse" data-bs-parent="#accordion3">
														<p>Join our affiliate program by signing up on our website and using your unique referral link to invite new users.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-6" aria-expanded="false" aria-controls="collapse3-6">Do you offer white-label solutions?</button>

													<div id="collapse3-6" class="collapse" data-bs-parent="#accordion3">
														<p>Yes, we provide white-label solutions for businesses looking to integrate our technology into their platforms.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-7" aria-expanded="false" aria-controls="collapse3-7">Can influencers collaborate?</button>

													<div id="collapse3-7" class="collapse" data-bs-parent="#accordion3">
														<p>Yes, we welcome influencers interested in promoting our platform. Contact our partnership team to discuss collaboration opportunities.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-8" aria-expanded="false" aria-controls="collapse3-8">How can I contact your partnership team?</button>

													<div id="collapse3-8" class="collapse" data-bs-parent="#accordion3">
														<p>You can reach out to our partnership team through the contact details provided on our Partnership page.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- end accordion -->
							</div>
						</div>

						<div class="tab-pane fade" id="tab-4" role="tabpanel">
							<div class="row">
								<!-- accordion -->
								<div class="col-12">
									<div class="accordion" id="accordion4">
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-1" aria-expanded="false" aria-controls="collapse4-1">When are profits from successful credited?</button>

													<div id="collapse4-1" class="collapse" data-bs-parent="#accordion4">
														<p>Profits from mining are typically credited to your profit account which you can withdraw to wallet shortly after the mining is completed.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-2" aria-expanded="false" aria-controls="collapse4-2">What payout options are available?</button>

													<div id="collapse4-2" class="collapse" data-bs-parent="#accordion4">
														<p>We offer only cryptocurrency transfers and payouts.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-3" aria-expanded="false" aria-controls="collapse4-3">Is there a minimum withdrawal amount?</button>

													<div id="collapse4-3" class="collapse" data-bs-parent="#accordion4">
														<p>Yes, there is a minimum withdrawal amount that varies depending on the cryptocurrency you're withdrawing.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-4" aria-expanded="false" aria-controls="collapse4-4">Are there any withdrawal fees?</button>

													<div id="collapse4-4" class="collapse" data-bs-parent="#accordion4">
														<p>Withdrawal fees may apply and can vary based on the cryptocurrency and withdrawal method. Please refer to our Withdrawal section for details.</p>
													</div>
												</div>
											</div>

											<div class="col-12 col-lg-6">
												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-5" aria-expanded="false" aria-controls="collapse4-5">How long does it take to withdrawals?</button>

													<div id="collapse4-5" class="collapse" data-bs-parent="#accordion4">
														<p>Withdrawal processing times vary depending on the cryptocurrency network and the withdrawal method chosen.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-6" aria-expanded="false" aria-controls="collapse4-6">Can I reinvest my profits immediately?</button>

													<div id="collapse4-6" class="collapse" data-bs-parent="#accordion4">
														<p>Yes, you can reinvest your profits immediately after they are credited to your account to continue mining.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-7" aria-expanded="false" aria-controls="collapse4-7">Are there any limits of withdrawals?</button>

													<div id="collapse4-7" class="collapse" data-bs-parent="#accordion4">
														<p>We have withdrawal limits in place to ensure security. You can find the specific limits in our Withdrawal section.</p>
													</div>
												</div>

												<div class="accordion__card">
													<button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-8" aria-expanded="false" aria-controls="collapse4-8">How can I ensure the security?</button>

													<div id="collapse4-8" class="collapse" data-bs-parent="#accordion4">
														<p>Enable two-factor authentication, use strong passwords, and follow our security recommendations to protect your payouts.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- end accordion -->
							</div>
						</div>
					</div>
				</div>
				<!-- end tabs content -->
			</div>
			
		</div>
	</section>
	<!-- end faq -->

	<!-- company -->
	<section class="section">
		<div class="container">
			<div class="row row--relative">
				<div class="col-12">
					<div class="company">
						<h2 class="company__title">Company registration</h2>
						
						<div class="row">
							<div class="col-12 col-xl-7">
								<p class="company__text">Integrity, reliability, transparency, flexibility and communication should be the core values of any company that works in the field of investment attraction. Centure adheres to absolutely all of these values so that our clients can have confidence and trust in us.</p>
								<p class="company__text">License No. <b>8597366</b></p>
							</div>

							<div class="col-12 col-xl-4 offset-xl-1">
								<p class="company__subtitle">Legal address:</p>
								<p class="company__text">99 Chancery Street, <br>Auckland Central, <br>Auckland, 1010, New Zealand</p>
							</div>
						</div>

						<!-- design elements -->
						<span class="block-icon block-icon--orange">
							<i class="ti ti-certificate-2"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
				</div>

				<!-- animation background -->
				<div class="section__canvas section__canvas--second" id="canvas2"></div>
			</div>
		</div>
	</section>
	<!-- end company -->
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/home.blade.php ENDPATH**/ ?>