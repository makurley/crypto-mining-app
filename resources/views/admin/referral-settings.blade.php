@extends('admin.layouts.master')
@section('title', 'Settings')

@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-3 row-deck mb-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header py-3 d-flex bg-transparent">
                        <h6 class="mb-0 fw-bold">Create Plan</h6>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
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
                        
                    <form action="{{ route('admin.referral-settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="bonus_amount" class="form-label">Referral Bonus Amount (%)</label>
            <input type="number" step="0.01" name="bonus_amount" id="bonus_amount" class="form-control" value="{{ old('bonus_amount', $settings->bonus_amount ?? 0) }}" required>
        </div>

        <div class="mb-3">
            <label for="referral_active" class="form-label">Referral Status</label>
            <select name="referral_active" id="referral_active" class="form-control">
                <option value="1" {{ isset($settings) && $settings->referral_active ? 'selected' : '' }}>On</option>
                <option value="0" {{ isset($settings) && !$settings->referral_active ? 'selected' : '' }}>Off</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Settings</button>
    </form>    
                        
                        
                           </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
@endsection