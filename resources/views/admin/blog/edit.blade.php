@extends('admin.layouts.master')
@section('title', 'Edit Blog')

@section('content')
<div class="container">
    <h2>Edit Blog Post</h2>

    <form method="POST" action="{{ route('admin.blogs.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
           <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
<div class="mb-3">
    <label>Category</label>
    <input type="text" name="category" value="{{ old('category', $post->category) }}" class="form-control" required>
</div>
        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5" required>{{ $post->body }}</textarea>
        </div>

        <div class="mb-3">
            <label>Image</label><br>
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="published" value="1" class="form-check-input" {{ $post->published ? 'checked' : '' }}>
            <label class="form-check-label">Published</label>
        </div>

        <button type="submit" class="btn btn-success">Update Post</button>
    </form>
</div>
@endsection
