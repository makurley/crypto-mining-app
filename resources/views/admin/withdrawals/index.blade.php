@extends('admin.layouts.master')

@section('content')


      <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Withdraw management</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    
                     @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
 <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Miners</h6> 
                                </div>
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                           <tr>
                <th>User</th>
                <th>Wallet Type</th>
                <th>Wallet Address</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>Action</th>
            </tr>
                                        </thead>
                                        <tbody>
                                               @forelse($withdrawals as $withdrawal)
            <tr>
                <td>{{ $withdrawal->user->name ?? 'N/A' }}</td>
                <td>{{ $withdrawal->wallet_type }}</td>
                <td>{{ $withdrawal->wallet_address }}</td>
                <td>${{ number_format($withdrawal->amount, 2) }}</td>
                <td>{{ ucfirst($withdrawal->status) }}</td>
                <td>{{ $withdrawal->created_at->format('d M Y h:i A') }}</td>
                <td>
                    @if($withdrawal->status === 'pending')
                        <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">Approve</button>
                        </form>
                    @else
                        <span class="badge bg-success">Approved</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="7">No withdrawals found.</td></tr>
        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->
                    @endsection
