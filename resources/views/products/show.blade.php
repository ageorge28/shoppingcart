@extends('layouts.app')

@section('content')

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See more Details</p>
						<h1>{{ $product->name }}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			
			<div class="position-fixed p-3" style="position: absolute; top: 100px; right: 0; z-index: 11">
			  <div id="liveToast" class="toast hide bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header">
				  <strong id="toast-title" class="me-auto">{{ $product->quantity > 0 ? 'Product Added' : 'Out of Stock' }}</strong>
				  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body" id="message-alert"></div>
			  </div>
			</div>

			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="{{ asset('uploads') . '/' . $product->image->filename }}" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3>{{ $product->name }}</h3>
						<p class="single-product-pricing"><span>Per Kg</span> ₹{{ $product->price }}</p>
						<p>{{ $product->description }}</p>
						<div class="single-product-form">
							<form action="#">
								<input id="cart-quantity" type="number" placeholder="1" value="1">
							</form>
							<a data-cart="{{ !is_null($cart) ? $cart->id : 0 }}" data-quantity="{{ $product->quantity }}" data-product-id="{{ $product->id }}" data-target="" href="{{ $product->quantity > 0 ? 'ajax/add/' . $product->id : '#' }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>{{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}</a>
							<p><strong>Categories: </strong>{{ $product->category->name }}</p>
						</div>
						<h4>Share:</h4>
						<ul class="product-share">
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->

	<!-- more products -->
	<div class="more-products mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Related</span> Products</h3>
						<p>{{ $product->category->description }}</p>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($products as $product)
					<div class="col-lg-4 col-md-6 text-center">
						<div class="single-product-item">
							<div class="product-image">
								<a href="../products/{{ Str::slug($product->name) }}"><img src="{{ asset('uploads') . '/' . $product->image->filename }}" alt=""></a>
							</div>
							<h3>{{ $product->name }}</h3>
							<p class="product-price"><span>Per Kg</span> ₹{{ $product->price }} </p>
							<a data-product-id="{{ Auth::user() ? $product->id : 0 }}" data-target="#exampleModal" href="{{ Auth::user() ? '../ajax/add/' . $product->id : '../login' }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- end more products -->

@endsection