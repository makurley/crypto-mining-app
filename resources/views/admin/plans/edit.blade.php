@extends('admin.layouts.master')
@section('title', 'Edit plan')

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

                    <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
   @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Plan Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $plan->name) }}" required>
    </div>
    <div class="form-group">
        <label for="hashrate">Hashrate</label>
        <input type="text" class="form-control" id="hashrate" name="hashrate" value="{{ $plan->hashrate }}" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
<input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $plan->price }}" required>
    </div>
    <div class="form-group">
        <label for="duration">Duration (Months)</label>
        <input type="number" class="form-control" id="duration" name="duration" value="{{ $plan->duration }}" required>

    </div>
    <div class="form-group">
        <label for="roi_value">ROI Value</label>
       <input type="number" step="0.01" class="form-control" id="roi_value" name="roi_value" value="{{ $plan->roi_value }}" required>

    </div>
    <div class="form-group">
        <label for="roi_type">ROI Type</label>
        <select class="form-control" id="roi_type" name="roi_type" value="">
            <option value="percentage">Percentage</option>
            <option value="fixed">Fixed</option>
        </select>
    </div>
      <div class="form-group">
       <label for="expected_profit" class="form-label">Expected Profit</label>
   <input type="number" step="0.01" name="expected_profit" class="form-control" value="{{ $plan->expected_profit }}" required>

    </div>
    <div class="form-group">
    <label for="sold_out">Sold Out?</label>
    <select name="sold_out" id="sold_out" class="form-control">
        <option value="0" {{ old('sold_out', $plan->sold_out ?? 0) == 0 ? 'selected' : '' }}>No</option>
        <option value="1" {{ old('sold_out', $plan->sold_out ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
    </select>
</div>
  <div class="form-group">
    <label for="power_charge">Power Charge ($)</label>
    <input type="number" name="power_charge" class="form-control" step="0.01"
           value="">
</div>
    <div class="form-group">
        <label for="badge">Badge</label>
        <select class="form-control" id="badge" name="badge">
            <option value="popular">Popular</option>
            <option value="recommended">Recommended</option>
            <option value="starters">Starters</option>
        </select>
    </div>
<br>
    <button type="submit" class="btn btn-primary">Update Plan</button>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
@endsection