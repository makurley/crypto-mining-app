@extends('admin.layouts.master')
@section('title', 'Kyc')
@section('content')


       


 <div class="body-header border-bottom d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <!-- Pretitle -->
                            <h1 class="h4 mt-1">KYC Management</h1>
                        </div>
                        <div class="col-12 col-md-6 text-md-end">
                            <a href="#" title="Download" target="_blank" class="btn btn-white border lift">Download</a>
                            <button type="button" class="btn btn-dark lift">Generate Report</button>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card no-bg">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0 align-items-center">
                                    <p class="mb-0 fw-bold ">SUBMITED KYC DATA</p> 
                                </div>
                                
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif
                                <div class="card-body">
                                    
                                    <table id="myProjectTable" class="priceTable table table-hover custom-table table-bordered align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                    <th>Document Type</th>
                    <th>Status</th>
                    <th>Document</th>
                    <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                @forelse($kycUsers as $user)
                    <tr>
                        <td>{{ $user->name }}<br><small>{{ $user->email }}</small></td>
                        <td>{{ str_replace('_', ' ', $user->kyc_document_type) }}</td>
                        <td>
                            @if($user->kyc_status == 'approved')
                                <span class="text-green-600 font-semibold">Approved</span>
                            @elseif($user->kyc_status == 'pending')
                                <span class="text-yellow-600 font-semibold">Pending</span>
                            @else
                                <span class="text-red-600 font-semibold">Rejected</span><br>
                                <small>{{ $user->kyc_rejection_reason }}</small>
                            @endif
                        </td>
                       <td>
 <a href="{{ route('admin.kyc.document.view', basename($user->kyc_document)) }}" target="_blank" class="text-blue-600 underline"> <button class="btn btn-light-danger">View Document</button></a>



</td>

                       <td>
                            @if($user->kyc_status !== 'approved')
                                <form action="{{ route('admin.kyc.approve', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-light-success">Approve</button>
                                </form>

                                <!-- Reject button with prompt -->
                                <form action="{{ route('admin.kyc.reject', $user->id) }}" method="POST" class="inline" onsubmit="return confirmReject(this)">
                                    @csrf
                                    <input type="hidden" name="reason">
                                    <button type="submit" class="btn btn-light-danger">Reject</button>
                                </form>
                            @else
                                <span class="text-sm text-gray-500">No actions</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">No KYC submissions yet.</td>
                    </tr>
                @endforelse
            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        


<script>
function confirmReject(form) {
    const reason = prompt("Enter reason for rejection:");
    if (reason === null || reason.trim() === "") {
        return false;
    }
    form.querySelector('input[name="reason"]').value = reason;
    return true;
}
</script>
@endsection
