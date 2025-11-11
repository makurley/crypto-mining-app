@extends('admin.layouts.master')

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

        <div class="container mt-5">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.miner-data.update', $miner->id) }}">
    @csrf
    
    <div class="mb-3">
        <input type="text" name="miner_location" value="{{ old('miner_location', $miner->miner_location) }}" class="form-control" placeholder="Miner Location" required>
    </div>

    <div class="mb-3">
        <input type="text" name="miner_ip" value="{{ old('miner_ip', $miner->miner_ip) }}" class="form-control" placeholder="Miner IP" required>
    </div>

    <div class="mb-3">
        <input type="text" name="up_time" value="{{ old('up_time', $miner->up_time) }}" class="form-control" placeholder="Uptime" required>
    </div>

    <div class="mb-3">
        <select name="status" class="form-control" required>
            <option value="active" {{ $miner->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="down" {{ $miner->status == 'down' ? 'selected' : '' }}>Down</option>
            <option value="cooling" {{ $miner->status == 'cooling' ? 'selected' : '' }}>Cooling</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Miner</button>
</form>

        </div>
    </div>
</div>
@endsection
