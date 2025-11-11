<h3 class="profile__title">Update Crypto Wallets</h3>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('user.crypto.wallets.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form__group">
        <label>BTC Wallet</label>
        <input type="text" name="btc" class="form__input"
               value="{{ old('btc', $wallets['btc'] ?? '') }}">
    </div>

    <div class="form__group">
        <label>ETH Wallet</label>
        <input type="text" name="eth" class="form__input"
               value="{{ old('eth', $wallets['eth'] ?? '') }}">
    </div>

    <div class="form__group">
        <label>USDT Wallet</label>
        <input type="text" name="usdt" class="form__input"
               value="{{ old('usdt', $wallets['usdt'] ?? '') }}">
    </div>

    <button type="submit" class="form__btn">Update Crypto Wallets</button>
</form>
