@extends('layouts.app')

@section('content')
	
		<!-- breadcrumb-section -->
		<div class="breadcrumb-section breadcrumb-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 text-center">
						<div class="breadcrumb-text">
							<p>Read the Details</p>
							<h1>Blog Post</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end breadcrumb section -->
		
		<!-- single article section -->
		<div class="mt-150 mb-150">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="single-article-section">
							<div class="single-article-text">
								<div class=""><img src="../uploads/{{ $blog->image->filename }}" /></div>
								<p class="blog-meta">
									<span class="author"><i class="fas fa-user"></i>{{ $blog->user->name }}</span>
									<span class="date"><i class="fas fa-calendar"></i>{{ Carbon\Carbon::parse($blog->date)->isoFormat('MMMM DD, YYYY') }}</span>
								</p>
								<h2>{{ $blog->title }}</h2>
								<p>{!! $blog->description !!}</p>
							</div>
	
						</div>
					</div>
					<div class="col-lg-4">
						<div class="sidebar-section">
							<div class="recent-posts">
								<h4>Recent Posts</h4>
								<ul>
									@foreach ($blogs as $recentblog)
										<li><a href="{{ route('blog', ['slug' => $recentblog->slug]) }}">{{ $recentblog->title }}</a></li>
									@endforeach
								</ul>
							</div>
							<div class="archive-posts">
								<h4>Categories</h4>
								<ul>
									@foreach ($blogcategories as $blogcategory)
										<li><a href="{{ route('blog.search_by_category', ['category' => Str::slug($blogcategory->name)]) }}">{{ $blogcategory->name }}</a></li>
									@endforeach
								</ul>
							</div>
							<div class="tag-section">
								<h4>Tags</h4>
								<ul>
									@foreach($blog->tags as $tag)
										<li><a href="{{ route('blog.search_by_tag', ['tag' => $tag->name]) }}">{{ $tag->name }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end single article section -->
		
		
@endsection