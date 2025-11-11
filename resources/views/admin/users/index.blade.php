
@extends('admin.layouts.master')

@section('content')


      <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Users</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
 <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">User Table</h6> 
                                </div>
                                 <!-- Success Notification -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

                           <div class="card-body">
    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Wallet (₦)</th>
                <th>Status</th>
                <th>User Online</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name ?? 'N/A' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>₦{{ number_format($user->wallet, 2) }}</td>
                    <td>
                        @if ($user->is_banned)
                            <span class="badge bg-danger">Banned</span>
                        @else
                            <span class="badge bg-success">Active</span>
                        @endif
                    </td>
                    <td>
                        @if($user->online === 'online')
                            <span class="badge bg-success">Online</span>
                        @else
                            <span class="badge bg-secondary">Offline</span>
                        @endif
                    </td>
                    <td>
                        <!-- Toggle Ban Form -->
                        <form method="POST" action="{{ route('admin.users.toggleBan', $user->id) }}" style="display:inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-warning">
                                {{ $user->is_banned ? 'Unban' : 'Ban' }}
                            </button>
                        </form>

                        <!-- Fund Wallet Button -->
                        <a href="{{ route('admin.fund.wallet') }}?user_id={{ $user->id }}" class="btn btn-sm btn-info">Fund Wallet</a>

                        <!-- Delete User Form -->
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

                            </div>
                        </div>
                    </div><!-- Row end  -->
                    @endsection
