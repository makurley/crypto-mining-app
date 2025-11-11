@extends('layouts.main')
@section('title', 'about')
@section('content')
<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<div class="section__title">
						<h1>About {{ $settings->title }}</h1>
						<p>At {{ $settings->title }}, we provide seamless access to crypto mining through our trusted cloud infrastructure. No need for expensive rigs, maintenance, or technical knowledge just choose a plan and start earning passive income daily.

Our goal is to democratize crypto mining by making it accessible, affordable, and transparent. We’ve combined cutting-edge hardware, real-time tracking, and crypto payouts to deliver a mining experience built for everyone from beginners to professionals.</p>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
<div class="section section--pb">
		<div class="container">
			<div class="row row--relative">
				<div class="col-12">
					<div class="about">
						<h2 class="about__title">Our Force</h2>

						<p class="about__text">{{ $settings->title }} is a next-generation cloud mining platform providing secure, scalable, and simple access to cryptocurrency mining. We believe mining should be accessible to everyone, not just tech experts or data center owners.</p>

						<p class="about__text">we believe in a decentralized future where anyone, anywhere can earn from cryptocurrency mining without the need for expensive hardware, complicated setups, or technical know-how.

We’re a blockchain infrastructure company dedicated to democratizing crypto mining by offering cutting-edge cloud mining solutions that are secure, scalable, and profitable. 
Our platform empowers users to mine cryptocurrencies like Bitcoin, Ethereum, USDT, and more, using our globally distributed mining farms remotely and efficiently.</p>
						
						<!-- design elements -->
						<span class="block-icon block-icon--purple">
							<i class="ti ti-binary"></i>
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
	<section class="section">
		<div class="container">
			<div class="row row--relative">
				<div class="col-12">
					<div class="company">
						<h2 class="company__title">Company registration</h2>
						
						<div class="row">
							<div class="col-12 col-xl-7">
								<p class="company__text">Founded by a team of crypto pioneers, fintech experts, and software engineers, {{ $settings->title }} was born out of a shared frustration: crypto mining was too complex and 
								expensive for most people. We set out to change that—designing a platform that lets everyday users participate in the blockchain economy without needing technical expertise or expensive rigs.<br>

From our humble beginnings, we’ve grown into a global platform with users mining from over 9 countries, generating consistent passive income daily.</p>
	<p class="company__text">
<b>Our Vision</b><br>
To be the #1 trusted cloud mining platform in the world, enabling financial freedom through crypto technology, education, and smart passive investment solutions.Integrity, reliability, transparency, flexibility and 
communication should be the core values of any company that works in the field of investment attraction. Centure adheres to absolutely all of these values so that our clients can have confidence and trust in us.</p>
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
		@endsection
	