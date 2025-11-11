<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__content">
                    <!-- Button for mobile navigation -->
                    <button class="header__btn" type="button" aria-label="header__nav">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- End button -->

 <!-- Logo -->
                    <a href="{{ route('dashboard') }}" class="header__logo">
								<img src="{{ url('public/' . $settings->logo) }}" alt="Site Logo" style="width: 150px; height: auto;" >
						</a>
						<!-- end logo -->

						<!-- tagline -->
						<span class="header__tagline">   </span>


                    <!-- Navigation -->
                    <ul class="header__nav" id="header__nav">
                         <li>
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        <li class="header__dropdown">
                            <a class="dropdown-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Miners <i class="ti ti-point-filled"></i> <!-- Dropdown icon -->
                            </a>
                            <ul class="dropdown-menu header__dropdown-menu">
                                <li><a href="{{ route('plans.my') }}">Active Miners</a></li>
                                <li><a href="{{ route('plans.list') }}">Rent Miner</a></li>
                                <li><a href="{{ route('profits.history') }}">Profit Ledger</a></li>
                            </ul>
                        </li>
                       <li class="header__dropdown">
                            <a class="dropdown-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                               Pool Mining <i class="ti ti-point-filled"></i> <!-- Dropdown icon -->
                            </a>
                            <ul class="dropdown-menu header__dropdown-menu">
                                <li><a href="{{ route('mining.history') }}">Pool Mining History</a></li>
                            </ul>
                        </li>
                          <li>
                            <a href="{{ route('user.miner.settings') }}">Configure Miner</a>
                        </li>
                        <li class="header__dropdown">
                            <a class="dropdown-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Transactions <i class="ti ti-point-filled"></i> <!-- Dropdown icon -->
                            </a>
                            <ul class="dropdown-menu header__dropdown-menu">
                                <li><a href="{{ route('user.withdraw.history') }}">Withdraw History</a></li>
                                <li><a href="{{ route('user.deposit.history') }}">Deposit History</a></li>
                                    <li><a href="{{ route('referral.history') }}">Referral Bonus History</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="blog.html">News</a>
                        </li>

                    </ul>
                    <!-- End navigation -->

                    <!-- Language selection -->
                    <div class="header__language">
                        <a class="dropdown-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            EN <i class="ti ti-point-filled"></i> <!-- Dropdown icon -->
                        </a>
                        <ul class="dropdown-menu header__language-menu">
                            <li><a href="#">English</a></li>
                            <li><a href="#">Spanish</a></li>
                            <li><a href="#">French</a></li>
                        </ul>
                    </div>
                    <!-- End language selection -->

                    <!-- Profile link -->
                          
                    <form method="POST" action="{{ route('logout') }}"  >
            @csrf
           	<button  class="btn btn-danger" type="submit"><i class="fas fa-power-off"></i> Sign out </button>
        </form>
                   
                    <!-- End profile link -->
                </div>
            </div>
        </div>
    </div>
</header>