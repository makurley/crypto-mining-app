@extends('admin.layouts.master')
@section('title', 'Create Post')

@section('content')
<div class="container">
    <h2>Create Blog Post</h2>
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
<div class="mb-3">
    <label>Category</label>
    <input type="text" name="category" class="form-control" required>
</div>
        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="published" value="1" class="form-check-input">
            <label class="form-check-label">Publish</label>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
@endsection
