@extends('admin.layouts.master')
@section('title', 'Blog')
@section('content')
<div class="container">
    <h2>All Blog Posts</h2>

    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">Create New Post</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->published ? 'Published' : 'Draft' }}</td>
                <td>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" width="80">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.blogs.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection
