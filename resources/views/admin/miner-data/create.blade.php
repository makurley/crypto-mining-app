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
                          <!-- Success Message -->
                          @if(session('success'))
                              <div class="alert alert-success">{{ session('success') }}</div>
                          @endif

                          <!-- Validation Errors -->
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif

                          <!-- Form Submission -->
                          <form action="{{ route('admin.miner-data.store') }}" method="POST">
                              @csrf

                              <div class="mb-3">
                                  <select name="miner_location" class="form-control" required>
                                      <option value="">Set Miner Location</option>
                                      <option value="United States">United States</option>
                                      <option value="United Kingdom">United Kingdom</option>
                                      <option value="Russia">Russia</option>
                                      <option value="Europe">Europe</option>
                                  </select>
                              </div>

                              <div class="mb-3">
                                  <input type="text" name="miner_ip" class="form-control" placeholder="Miner IP" required>
                              </div>

                              <div class="mb-3">
                                  <input type="text" name="up_time" class="form-control" placeholder="Uptime" required>
                              </div>

                              <div class="mb-3">
                                  <select name="status" class="form-control" required>
                                      <option value="active">Active</option>
                                      <option value="down">Down</option>
                                      <option value="cooling">Cooling</option>
                                  </select>
                              </div>

                              <button type="submit" class="btn btn-primary">Add Miner</button>
                          </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
