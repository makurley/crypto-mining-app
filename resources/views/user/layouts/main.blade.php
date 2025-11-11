<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
			<link rel="stylesheet" href="{{asset('assets/css/splide.min.css')}}" />
			<link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
<link rel="stylesheet" href="{{asset('assets/country/build/css/countrySelect.css')}}">
		<!--<link rel="stylesheet" href="{{asset('assets/country/build/css/demo.css')}}">-->
	<!-- Icon font -->
	<link rel="stylesheet" href="{{asset('assets/webfont/tabler-icons.min.css')}}" />
	<!-- Favicons -->
<link rel="icon" href="{{ url('public/' . $settings->favicon) }}" type="image/png">

	<meta name="description" content="{{ $settings->title }}">
	<meta name="keywords" content="">
	<title>{{ $settings->title }}</title>
	<style>
        /* Preloader Styling */
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #16142a;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #preloader img {
            width: 100px;
        }
    </style>
   <!-- Use Bootstrap 4 instead -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
:root {
  --bs-body-font-family: 'Manrope', sans-serif;
}

body {
  font-family: 'Manrope', sans-serif !important;
}
</style>
</head>

<body class="body body--home">
    <div id="preloader">
    <img src="{{ url('public/' . $settings->logo) }}" alt="Site Logo" class="" width="50">
  <img src="{{asset('public/assets/img/preloader.gif')}}" alt="Site Logo" class="" >
</div>
	<!-- header -->

 @include('user.layouts.header')

	<!-- end header -->
	

	  @yield('content')


	<!-- footer -->
<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4 order-1 order-lg-4 order-xl-1">
					<!-- footer logo -->
					<div class="footer__logo">
					<img src="{{ url('public/' . $settings->logo) }}" alt="Site Logo" style="width: 120px; height: auto;" class="header__logo">
					</div>
					<!-- end footer logo -->

					<!-- footer tagline -->
					<p class="footer__tagline">{{ $settings->description }}</p>
					<!-- end footer tagline -->

				</div>

				<!-- navigation -->
				<div class="col-6 col-md-4 col-lg-3 col-xl-2 order-3 order-md-2 order-lg-2 order-xl-3 offset-md-2 offset-lg-0">
					<h6 class="footer__title">Company</h6>
					<div class="footer__nav">
						<a href="about.html">About Centure</a>
						<a href="blog.html">Our news</a>
						<a href="about.html">License</a>
						<a href="contacts.html">Contacts</a>
					</div>
				</div>

				<div class="col-12 col-md-8 col-lg-6 col-xl-4 order-2 order-md-3 order-lg-1 order-xl-2">
					<div class="row">
						<div class="col-12">
							<h6 class="footer__title">Services & Features</h6>
						</div>

						<div class="col-6">
							<div class="footer__nav">
								<a href="invest.html">Invest</a>
								<a href="token.html">Token</a>
								<a href="affiliate.html">Affiliate</a>
								<a href="contest.html">Contest</a>
							</div>
						</div>

						<div class="col-6">
							<div class="footer__nav">
								<a href="about.html">Safety</a>
								<a href="about.html">Automatization</a>
								<a href="about.html">Analytics</a>
								<a href="reports.html">Reports</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-6 col-md-4 col-lg-3 col-xl-2 order-4 order-md-4 order-lg-3 order-xl-4">
					<h6 class="footer__title">Support</h6>
					<div class="footer__nav">
						<a href="faq.html">Help center</a>
						<a href="how.html">How it works</a>
						<a href="privacy.html">Privacy policy</a>
						<a href="privacy.html">Terms & conditions</a>
					</div>
				</div>
				<!-- end navigation -->
			</div>

			<div class="row">
				<div class="col-12">
					<div class="footer__content">
						<!-- footer social -->
						<div class="footer__social">
							<a href="#" target="_blank"><i class="ti ti-brand-facebook"></i></a>
							<a href="#" target="_blank"><i class="ti ti-brand-x"></i></a>
							<a href="#" target="_blank"><i class="ti ti-brand-instagram"></i></a>
							<a href="#" target="_blank"><i class="ti ti-brand-telegram"></i></a>
							<a href="#" target="_blank"><i class="ti ti-brand-discord"></i></a>
							<a href="#" target="_blank"><i class="ti ti-brand-linkedin"></i></a>
						</div>
						<!-- end footer social -->

						<!-- footer copyright -->
						<small class="footer__copyright">© Copyright {{ $settings->title }} | {{ now()->year }}. </small>
						<!-- end footer copyright -->
					</div>
				</div>
			</div>
		</div>

		<!-- design elements -->
		<span class="screw screw--footer screw--footer-bl"></span>
		<span class="screw screw--footer screw--footer-br"></span>
		<span class="screw screw--footer screw--footer-tr"></span>
		<span class="screw screw--footer screw--footer-tl"></span>
	</footer>
	<!-- end footer -->

	<!-- ask modal -->
	<div class="modal modal--auto fade" id="modal-ask" tabindex="-1" aria-labelledby="modal-ask" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>

					<h4 class="modal__title">Ask a question</h4>

					<p class="modal__text">Our support team is always on call, and ready to help with all your questions!</p>

					<form action="#" class="modal__form">
						<div class="form__group">
							<input name="name" type="text" class="form__input" placeholder="Name">
						</div>

						<div class="form__group">
							<input name="mail" type="text" class="form__input" placeholder="Email">
						</div>

						<div class="form__group">
							<textarea name="question" class="form__textarea" placeholder="Your question"></textarea>
						</div>

						<button class="form__btn" type="button">Send</button>
					</form>

					<!-- design elements -->
					<span class="screw screw--big-tl"></span>
					<span class="screw screw--big-bl"></span>
					<span class="screw screw--big-br"></span>
				</div>
			</div>
		</div>
	</div>
	<!-- end ask modal -->

	<!-- JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/js/smooth-scrollbar.js')}}"></script>
	<script src="{{asset('assets/js/splide.min.js')}}"></script>
	<script src="{{asset('assets/js/three.min.js')}}"></script>
	<script src="{{asset('assets/js/vanta.fog.min.js')}}"></script>
	<script src="{{asset('assets/js/main.js')}}"></script>
	<script>
    window.addEventListener("load", function () {
        // Enforce a minimum 5-second delay before showing content
        setTimeout(function () {
            const preloader = document.getElementById("preloader");
            const content = document.getElementById("main-content");

            preloader.style.opacity = "0";
            preloader.style.transition = "opacity 0.1s ease";

            setTimeout(function () {
                preloader.style.display = "none";
                content.style.display = "block";
            }, 500); // Give fade-out time
        }, 2000); // 5 seconds delay
    });
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="{{asset('assets/country/build/js/countrySelect.js')}}"></script>
		<script>
			$("#country_selector").countrySelect({
				// defaultCountry: "jp",
				// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
				// responsiveDropdown: true,
				preferredCountries: ['ca', 'gb', 'us']
			});
		</script>


@stack('scripts')
</body>

</html>