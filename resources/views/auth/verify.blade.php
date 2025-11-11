

@extends('auth.layouts.main')
@section('title', 'Login')
@section('content')


	<!-- page wrap -->
	<div class="section section--content">
		<div class="section__content">
		    
		    		<!-- form -->
		<!-- form -->
<!-- Success/Error Notification -->
<form method="POST" class="form form--content" action="{{ route('verification.send') }}">
    @csrf

    {{-- Session flash messages --}}
    @if (session('status'))
        <div class="alert alert-success text-success text-center mb-3">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-white text-center mb-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="form__logo-wrap">
        <a href="" class="form__logo">
            <img src="{{ url('/' . $settings->logo) }}" alt="Site Logo" class="header__logo">
        </a>
    </div>

    <button class="form__btn" type="submit">Resend Verification Email</button>

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