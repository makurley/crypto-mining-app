

@extends('layouts.main')
@section('title', 'Post details')
@section('content')
<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<div class="section__title">
						<h1>{{ $post->title }}</h1>	</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-xl-10 offset-xl-1">
					<div class="article">
						<!-- article content -->
						<div class="article__content">
							<div class="article__meta">
								<a href="#" class="article__category text-red">{{ $post->category }}</a>

								<span class="article__date"><i class="ti ti-calendar-up"></i>{{ $post->created_at->format('d M Y') }}</span>
							</div>
							@if($post->image)
   <img src="{{ asset('public/storage/' . $post->image) }}">
@endif

						
							    <p>{!! nl2br(e($post->body)) !!}</p>
							  
							
						</div>
						<!-- end article content -->

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end article -->
		@endsection
	