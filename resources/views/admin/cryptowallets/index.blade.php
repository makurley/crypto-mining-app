
@extends('admin.layouts.master')
@section('title', 'Create plan')

@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-3 row-deck mb-3">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header py-3 d-flex bg-transparent">
                        <h6 class="mb-0 fw-bold">Create Plan</h6>
                    </div>
                    <div class="card-body">
                        <!-- Error Notification -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.cryptowallets.store') }}" method="POST">
        @csrf
    <div class="form-group">
    <label for="crypto_name">Crypto Name</label>
    <select class="form-control" id="crypto_name" name="crypto_name" required>
        <option value="" disabled selected>Select a cryptocurrency</option>
        <option value="bitcoin">Bitcoin (BTC)</option>
        <option value="ethereum">Ethereum (ETH)</option>
        <option value="usdt">USDT</option>
        <!-- Add more options as needed -->
    </select>
</div>
    <div class="form-group">
        <label for="hashrate">Wallet Address</label>
        <input type="text" class="form-control" id="wallet_address" name="wallet_address" required>
    </div><br>
   
 <div class="form-group">
    <button type="submit" class="btn btn-primary">Save Wallet</button>
    </div>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
               



 <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Miners</h6> 
                                </div>
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                      <thead>
            <tr>
                <th>Crypto Name</th>
                <th>Wallet Address</th>
            </tr>
        </thead>
                                        <tbody>
                                              @foreach($wallets as $wallet)
            <tr>
                <td>{{ $wallet->crypto_name }}</td>
                <td>{{ $wallet->wallet_address }}</td>
            </tr>
            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->
                    @endsection
