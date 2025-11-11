
@extends('auth.layouts.main')
@section('title', 'Login')
@section('content')


	<!-- page wrap -->
	<div class="section section--content">
		<div class="section__content">
			<!-- form -->
		 <form method="POST" class="form form--content" action="{{ route('login.post') }}">
		     
	   @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
		      @csrf
				<div class="form__logo-wrap">
					<a href="" class="form__logo">
						<img src="{{ url('public/' . $settings->logo) }}" alt="Site Logo" style="width: 150px; height: auto;">
					</a></div>
					 <div class="form__group">
<span class="form__text form__text--center">Sign in</span></div>

				<div class="form__group">
					<input type="email" class="form__input" name="email" placeholder="Email" required>
				</div>

				<div class="form__group">
					<input type="password" name="password" class="form__input" placeholder="Password" required>
				</div>

				<div class="form__group form__group--checkbox">
					<input id="remember" name="remember" type="checkbox">
					<label for="remember">Remember Me</label>
				</div>
				
				<button class="form__btn" type="submit">Sign in</button>

				<span class="form__delimiter">or</span>

				<div class="form__social">
					<a class="fb" href="#"><i class="ti ti-brand-facebook"></i></a>
					<a class="tw" href="#"><i class="ti ti-brand-x"></i></a>
					<a class="gl" href="#"><i class="ti ti-brand-google"></i></a>
				</div>

				<span class="form__text form__text--center">Don't have an account? <a href="{{ route('register') }}">Sign up!</a><br> <a href="{{ route('password.request') }}">Forgot password?</a><br> <a href="{{ route('home') }}">Home</a></span>
                
				<!-- design elements -->
				<span class="block-icon block-icon--purple">
					<i class="ti ti-login"></i>
				</span>
				<span class="screw screw--big-tr"></span>
				<span class="screw screw--big-bl"></span>
				<span class="screw screw--big-br"></span>
			</form>
			<!-- end form -->
		</div>

		<!-- animation background -->
	
	</div>
	<!-- end page wrap -->


	@endsection