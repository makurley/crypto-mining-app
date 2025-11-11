@extends('user.layouts.main')

@section('content')

<div class="section section--head">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                <div class="section__title">
                    <h1>Confirm Your Deposit</h1>
                </div>
            </div>

            <div class="section section--pb">
                <div class="container">
                    <div class="row row--relative">
                        <form action="{{ route('user.deposit.confirm', $deposit->id) }}" method="POST">
                            @csrf
                            <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                                <div class="about">
                                    <h3 class="about__text">
                                        <strong>Pay:</strong> ${{ number_format($deposit->amount, 2) }}</h3>
                                         <p class="about__text"> <strong>Crypto Amount:</strong> {{ $deposit->crypto_amount }} {{ $deposit->crypto_type }}</p>
                                         <p class="about__text"> <strong>To Wallet:</strong> {{ $deposit->wallet_address }}</p>
                                         <p class="about__text">Status: <b>{{ ucfirst($deposit->status) }}</b></p>
                                    <br>

                                    <input type="text" name="user_confirm" id="user_confirm" class="apool__input" value="I've made payment" hidden>

                                    <div class="col-12 text-center"> <!-- Centering the button -->
                                        <button class="form__btn form__btn--small" type="submit">Confirm Payment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Animation background -->
                <div class="section__canvas section__canvas--page section__canvas--first" id="canvas"></div>
            </div>
            <!-- End Title -->
        </div>
    </div>
</div>
<!-- End Head -->

@endsection