@extends('user.layouts.main')
@section('content')

    	<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h1>Congratulations</h1>
						<p>You have successfully purchased the plan: <strong>{{ session('plan_name') }}</strong></p>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<!-- end head -->

	<!-- about -->
	<div class="section section--pb">
    <div class="container">
        <div class="row row--relative">
            <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                <div class="about text-center">
                   <p class="about__text">
    <strong>${{ number_format(session('price'), 2) }}</strong> has been deducted from your wallet, and your expected profit after mining is <strong>${{ number_format(session('expected_profit'), 2) }}</strong>.
    <br><br>
    Your plan will expire on <strong>{{ \Carbon\Carbon::parse(session('expires_at'))->format('M d, Y') }}</strong>.
</p> <br>
                    <a href="{{ route('plans.my') }}" class="apool__btn">View My Active Plans</a>
                </div>
            </div>
        </div>
    </div>
    <!-- animation background -->
    <div class="section__canvas section__canvas--page section__canvas--first" id="canvas"></div>
</div>
	<!-- end about -->

			</div>
		</div>
	</div>
@endsection

