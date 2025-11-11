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
					   <a href="<?php echo e(route('home')); ?>" class="header__logo">
	<img src="<?php echo e(url('public/' . $settings->logo)); ?>" alt="Site Logo" style="width: 150px; height: auto;">


						</a>
						<!-- end logo -->

						<!-- tagline -->
						<span class="header__tagline"></span>
						<!-- end tagline -->

						<!-- navigation -->
						<ul class="header__nav" id="header__nav">
						      <li>
								<a href="<?php echo e(route('home')); ?>">Home</a>
							</li>
						

							<li>
								<a href="<?php echo e(route('about')); ?>">About</a>
							</li>
                              <li class="header__dropdown">
                            <a class="dropdown-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Services & Features <i class="ti ti-point-filled"></i> <!-- Dropdown icon -->
                            </a>
                            <ul class="dropdown-menu header__dropdown-menu">
                                <li><a href="<?php echo e(route('mining.contracts')); ?>">Mining Contracts</a></li>
                            </ul>
                        </li>
							<li>
								<a href="<?php echo e(route('protocols')); ?>">Protocols</a>
							</li>
							<li>
								<a href="<?php echo e(route('blog.index')); ?>">News</a>
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
						<a href="<?php echo e(route('login')); ?>" class="header__profile">
							<i class="ti ti-user-circle"></i>
							<span>Login</span>
						</a>
						<!-- end profile -->
					</div>
				</div>
			</div>
		</div>
	</header><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/layouts/header.blade.php ENDPATH**/ ?>