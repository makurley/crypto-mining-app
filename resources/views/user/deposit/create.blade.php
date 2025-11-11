<form action="{{ route('user.deposit.store') }}" method="POST">
    @csrf
    <label for="crypto_type">Select Crypto:</label>
    <select name="crypto_type" id="crypto_type" required>
        @foreach($cryptoOptions as $option)
            <option value="{{ $option->crypto_name }}">{{ $option->crypto_name }}</option>
        @endforeach
    </select>

    <label for="amount">Amount in USD:</label>
    <input type="number" name="amount" step="0.01" required>

    <button type="submit">Deposit</button>
</form>