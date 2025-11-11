@extends('user.layouts.main')

@section('content')

<div class="section section--head">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                <div class="section__title">
                    <h1>Withdrawal Confirmation</h1>
                </div>
            </div>

            <div class="section section--pb">
                <div class="container">
                    <div class="row row--relative">
                            <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                                <div class="about">
                                    <h3 class="about__text">
                                        <strong>Recieving Wallet Type:</strong> {{ ucfirst($withdrawal->wallet_type) }}</h3>
                                         <p class="about__text"> <strong>Wallet Address:</strong>{{ $withdrawal->wallet_address }}</p>
                                         <p class="about__text"> <strong>Amount:</strong> ${{ number_format($withdrawal->amount, 2) }}</p>
                                         <p class="about__text"><strong>Status:</strong> {{ ucfirst($withdrawal->status) }}</p>
                                    <br>

                                    <input type="text" name="user_confirm" id="user_confirm" class="apool__input" value="I've made payment" hidden>

                                    <div class="col-12 text-center"> <!-- Centering the button -->
                                        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Back to Dashboard</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- Animation background -->
            </div>
            <!-- End Title -->
        </div>
    </div>
</div>
<!-- End Head -->



@endsection