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
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Miners</h6> 
                                </div>
                                <div class="card-body">
                                 <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
    <thead>
        <tr>
            <th>User</th>
            <th>Plan</th>
            <th>Status</th>
            <th>Expected Profit</th>
            <th>Expires At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($userPlans as $plan)
        @php
            $isExpired = \Carbon\Carbon::now()->greaterThan($plan->expires_at);
        @endphp
        <tr>
            <td>{{ $plan->user->name }}</td>
            <td>{{ $plan->plan->name ?? 'N/A' }}</td>
            <td>
                @if($plan->status === 'active' && !$isExpired)
                    <span class="badge bg-success">Active</span>
                @elseif($isExpired)
                    <span class="badge bg-danger">Expired</span>
                @else
                    <span class="badge bg-secondary">Completed</span>
                @endif
            </td>
            <td>{{ $plan->expected_profit }}</td>
            <td>{{ $plan->expires_at->format('Y-m-d') }}</td>
            <td>
                @if($plan->status === 'completed')
                    <span class="badge bg-secondary">Completed</span>
                @elseif(!$isExpired)
                    <button class="btn btn-warning btn-sm" disabled>In Progress</button>
                @else
                    <form action="{{ route('admin.payProfit', $plan->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-success btn-sm">Pay Profit</button>
                    </form>
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
