@extends('user.layouts.main')
@section('title', 'Profile')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="mb-4">My Profile</h3>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" value="{{ Auth::user()->username }}" class="form-control" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" class="form-control" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <textarea name="address" class="form-control">{{ old('address', Auth::user()->address) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection
