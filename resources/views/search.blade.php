@extends('layouts.app')

@section('content')

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Search Results</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row">
				<div class="col-12 text-center">
					<div class="message-alert"></div>
					<br />
				</div>
			</div>

			<div class="row">
                <div class="col-md-12">
                    <div class="category-filters">
						<form method="GET" action="{{ route('filter') }}">
							@csrf	
							<input type="hidden" name="keywords" id="keywords" value="{{ $keywords }}" />
							<div class="row">			
			
							<div class="col">

								<div class="dropdown">
									<button class="category-filters btn btn-lg dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
									  Categories
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
										<li class="">
											<input class="form-check-input" type="checkbox" name="categories[]" id="all_category" value="0" {{ $filter_all ? 'checked' : '' }}  />&nbsp;&nbsp;All
										</li>
 										@foreach($categories as $category)
											<li class="{{ in_array($category->id, $filters) ? 'active' : '' }}">
												<input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" 
												{{ in_array($category->id, $filters) ? 'checked' : '' }}
												/>
												&nbsp;&nbsp;{{ $category->name }}
											</li>
										@endforeach
										</ul>
								</div>

							</div>
							<div class="col">
								<ul>
									<li>
										<select id="sort" name="sort">
											<option value="asc" {{ $sort == 'asc' ? ' selected' : ''}}>Price - Low to High</option>
											<option value="desc" {{ $sort == 'desc' ? ' selected' : ''}}>Price - High to Low</option>
										</select>
									</li>
								</ul>
							</div>
							<div class="col">
								<ul>
							<li style="all:unset">
									<button id="search-btn" type="submit">Submit</button>
								</li>
							</ul>
							</div>
						</div>
						</form>
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
								<p class="product-price"><span>Per Kg</span> {{ $product->price }}$ </p>
								<a data-product-id="{{ Auth::user() ? $product->id : 0 }}" data-target="#exampleModal" href="{{ Auth::user() ? route('ajax.add', ['product_id' => $product->id]) : route('login') }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
							</div>
						</a>
					</div>
				@endforeach
			</div>

			{{ $totalcount <= 6 ? '' : $products->appends(request()->query())->links('layouts.pagination') }}
			
			<div class="row">
				<div class="col-12 text-center">
					<br />
					<div class="message-alert"></div>
				</div>
			</div>

		</div>
	</div>
	<!-- end products -->

@endsection