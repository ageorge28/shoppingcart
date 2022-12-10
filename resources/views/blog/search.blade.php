@extends('layouts.app')

@section('content')

<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Organic Information</p>
					<h1>Blog</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- latest news -->
<div class="latest-news mt-150 mb-150">
	<div class="container">
		<div class="row">
			@foreach($blogs as $blog)
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="{{ route('blog', ['slug' => $blog->slug]) }}"><div class=""><img src="{{ asset('uploads/'. $blog->image->filename) }}" /></div></a>
						<div class="news-text-box">
							<h3><a href="{{ route('blog', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i>{{ $blog->user->name }}</span>
								<span class="date"><i class="fas fa-calendar"></i>{{ Carbon\Carbon::parse($blog->date)->isoFormat('MMMM DD, YYYY') }}</span>
							</p>
							<p class="excerpt">{!! $blog->description !!}</p>
							<a href="{{ route('blog', ['slug' => $blog->slug]) }}" class="read-more-btn">Read More <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		{{ $totalcount <= 3 ? '' : $blogs->links('layouts.pagination') }}

			</div>
		</div>
	</div>
</div>
<!-- end latest news -->

@endsection