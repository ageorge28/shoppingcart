@extends('layouts.app')

@section('content')

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Shop</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			{{-- <div class="row">
				<div class="col-12 text-center">
					<div id="message-alert"></div>
					<br />
				</div>
			</div> --}}

			<div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
							<a href="{{ route('products') }}">
	                            <li class="{{ is_null($category) ? 'active' : '' }}">All</li>
							</a>	
							@foreach($categories as $each_category)
								@if (count($each_category->products) > 0)
									<a href="{{ route('products.category', ['slug' => Str::slug($each_category->name)]) }}">
										<li class="{{ !is_null($category) && $category->name == $each_category->name ? 'active' : '' }}">
											{{ $each_category->name }}
										</li>
									</a>
								@endif
							@endforeach
                        </ul>
                    </div>
                </div>
            </div>

			<div class="row product-lists">
				@foreach($products as $product)
					<div class="col-lg-4 col-md-6 text-center {{ $product->category->name }}">
						<a href="{{ route('product', ['slug' => Str::slug($product->name)]) }}">	
							<div class="single-product-item">
								<div class="product-image">
									<img src="{{ asset('uploads') . '/' . $product->image->filename }}" alt="">
								</div>
								<h3>{{ $product->name }}</h3>
								<p class="product-price"><span>Per Kg</span>₹{{ $product->price }} </p>
								<a data-quantity="{{ $product->quantity }}" data-product-id="{{ $product->id }}" data-target="" href="{{ $product->quantity > 0 ? route('ajax.add', ['product_id' => $product->id])  : '#' }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>{{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}</a>
							</div>
						</a>
					</div>
				@endforeach
			</div>

			{{-- @include('layouts.pagination') --}}
			{{ $totalcount <= 6 ? '' : $products->links('layouts.pagination') }}

			<div class="position-fixed p-3" style="position: absolute; top: 100px; right: 0; z-index: 11">
			  <div id="liveToast" class="toast hide bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header">
				  <strong id="toast-title" class="me-auto">Product Added</strong>
				  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body" id="message-alert"></div>
			  </div>
			</div>


			{{-- <div class="row">
				<div class="col-12 text-center">
					<br />
					<div id="message-alert"></div>
				</div>
			</div> --}}

		</div>
	</div>
	<!-- end products -->

@endsection