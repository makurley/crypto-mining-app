@extends('admin.layouts.master')

@section('content')


      <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Mining Plans</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
 <div class="card mb-3">
     @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Miners</h6> 
                                </div>
                                <div class="card-body">
                                  <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Crypto Type</th>
                                        <th>Hashrate (TH/s)</th>
                                        <th>Total Price ($)</th>
                                        <th>Duration (days)</th>
                                        <th>Mining End Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($miningPurchases as $purchase)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $purchase->user->username }}</td>
                                            <td>{{ $purchase->crypto_type }}</td>
                                            <td>{{ $purchase->hashrate }} TH/s</td>
                                            <td>${{ number_format($purchase->total_price, 2) }}</td>
                                            <td>{{ $purchase->duration_days }} days</td>
                                            <td>{{ \Carbon\Carbon::parse($purchase->end_date)->format('d M Y') }}</td>
                                            <td>
                                                @if($purchase->end_date <= now())
                                                    <span class="status pending">Expired</span>
                                                @else
                                                    <span class="status running">Running</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($purchase->end_date <= now())
                                                    <form action="{{ route('admin.mining.payout', $purchase) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Payout</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-secondary" disabled>Running</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->
                    @endsection
