@extends('layouts.main')
@section('title', $settings->title . ' Blog')

@section('content')
<div class="section section--head">
    <div class="container">
        <div class="row">
            <!-- title -->
            <div class="col-12">
                <div class="section__title">
                    <h1>{{ $settings->title }} Blog</h1>
                    <p>Stay informed with the latest updates from MineWatts. Explore news about our mining 
                    infrastructure developments, industry insights, cryptocurrency trends, investment opportunities, 
                    promotional offers, token launches, platform updates, and much more—all in one place.</p>
                </div>
            </div>
            <!-- end title -->
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <!-- post -->
            @foreach($posts as $post)
            <div class="col-12 col-md-12 col-lg-6">
                <div class="post">
                    <a href="{{ route('blog.show', $post->slug) }}" class="post__img">
                        @if($post->image)
                         <img src="{{ asset('public/storage/' . $post->image) }}">

                        @endif
                    </a>

                    <div class="post__content">
                        <a href="#" class="post__category">{{ $post->category }}</a>
                        <h3 class="post__title text-white">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <div class="post__meta">
                            <span class="post__date">
                                <i class="ti ti-calendar-up"></i> {{ $post->created_at->format('d.m.y') }}
                            </span>
                            <span class="post__views">
                                <i class="ti ti-eye"></i> {{ rand(10, 100) }} <!-- Replace with real views logic if needed -->
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- end post -->
        </div>

        <!-- pagination -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
        <!-- end pagination -->
    </div>
</div>

@endsection
