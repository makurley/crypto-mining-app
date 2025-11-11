	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="header__content">
						<!-- btn -->
						<button class="header__btn" type="button" aria-label="header__nav">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<!-- end btn -->

						<!-- logo -->
						<a href="">
		<img src="{{ url('public/' . $settings->logo) }}" alt="Site Logo" class="header__logo">

						</a>
						<!-- end logo -->

						<!-- tagline -->
						<span class="header__tagline">{{ $settings->title }}</span>
						<!-- end tagline -->

						<!-- navigation -->
						<ul class="header__nav" id="header__nav">
						      <li>
								<a href="{{ route('home') }}">Home</a>
							</li>
						

							<li>
								<a href="{{ route('about') }}">About</a>
							</li>

							<li>
								<a href="{{ route('mining.pools') }}">Mine Pools</a>
							</li>

						</ul>
						<!-- end navigation -->

						<!-- language -->
						<div class="header__language">
							<a class="dropdown-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">EN <i class="ti ti-point-filled"></i></a>

							<ul class="dropdown-menu header__language-menu">
								<li><a href="#">English</a></li>
								<li><a href="#">Spanish</a></li>
								<li><a href="#">French</a></li>
							</ul>
						</div>
						<!-- end language -->

						<!-- profile -->
						<a href="{{ route('login') }}" class="header__profile">
							<i class="ti ti-user-circle"></i>
							<span>Login</span>
						</a>
						<!-- end profile -->
					</div>
				</div>
			</div>
		</div>
	</header>