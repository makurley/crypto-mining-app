
@extends('auth.layouts.main')
@section('title', 'Login')
@section('content')


	<!-- page wrap -->
	<div class="section section--content">
		<div class="section__content">

			<!-- form -->
		 <form method="POST" class="form form--content" action="{{ route('password.email') }}">
		     		     
@csrf
				<div class="form__logo-wrap">
					<a href="" class="form__logo">
						<img src="{{asset('assets/img/logo.svg')}}" alt="">
					</a>
					<span class="form__tagline">Cloud Phanton</span>
				</div>
	  @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
				<div class="form__group">
				    <label class="form__label">Forgot Password</label>
					<input type="email" class="form__input" name="email" placeholder="Email" required>
				</div>
				
				<button class="form__btn" type="submit">FORGOT PASSWORD</button>
                	<span class="form__text form__text--center">Remember password? <a href="{{ route('login') }}">Login</a></span>
			
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