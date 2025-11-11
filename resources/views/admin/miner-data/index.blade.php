@extends('admin.layouts.master')

@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-3 row-deck mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3 bg-transparent d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold">All Miners</h6>
                        <a href="{{ route('admin.miner-data.create') }}" class="btn btn-sm btn-primary">Add New Miner</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>IP</th>
                                        <th>Uptime</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($miners as $miner)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $miner->miner_location }}</td>
                                            <td>{{ $miner->miner_ip }}</td>
                                            <td>{{ $miner->up_time }}</td>
                                            <td>
                                                <span class="badge bg-{{ $miner->status === 'active' ? 'success' : ($miner->status === 'down' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($miner->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.miner-data.edit', $miner->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No miner data available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $miners->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
