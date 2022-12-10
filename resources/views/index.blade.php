@extends('layouts.app')

@section('content')

    <div class="homepage-slider">
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Fresh & Organic</p>
                                <h1>Delicious Seasonal Fruits</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('products') }}" class="boxed-btn">Fruit Collection</a>
                                    <a href="{{ route('contact') }}" class="bordered-btn">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Fresh Everyday</p>
                                <h1>100% Organic Collection</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('products') }}" class="boxed-btn">Visit Shop</a>
                                    <a href="{{ route('contact') }}" class="bordered-btn">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">Mega Sale Going On!</p>
                                <h1>Get December Discount</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('products') }}" class="boxed-btn">Visit Shop</a>
                                    <a href="{{ route('contact') }}" class="bordered-btn">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end home page slider -->

    <!-- features list section -->
    <div class="list-section pt-80 pb-80">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="content">
                            <h3>Free Shipping</h3>
                            <p>When order over ₹75</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3>24/7 Support</h3>
                            <p>Get support all day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-sync"></i>
                        </div>
                        <div class="content">
                            <h3>Refund</h3>
                            <p>Get refund within 3 days!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end features list section -->

    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">	
                        <h3><span class="orange-text">Our</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                    </div>
                </div>
            </div>

			<div class="position-fixed p-3" style="position: absolute; top: 100px; right: 0; z-index: 11">
                <div id="liveToast" class="toast hide bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong id="toast-title" class="me-auto">Product Added</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body" id="message-alert"></div>
                </div>
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 text-center">
                        <a href="{{ route('product', ['slug' => Str::slug($product->name)]) }}">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ asset('uploads') . '/' . $product->image->filename }}" alt="">
                                </div>
                                <h3>{{ $product->name }}</h3>
                                <p class="product-price"><span>Per Kg</span>₹{{ $product->price }}</p>
								<a data-quantity="{{ $product->quantity }}" data-product-id="{{ $product->id }}" data-target="" href="{{ $product->quantity > 0 ? route('ajax.add', ['product_id' => $product->id]) : '#' }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>{{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}</a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->

    <!-- cart banner section -->
<!--
    <section class="">
        <div class="container">
            <div class="row clearfix">
                <div class="image-column col-lg-6">
                    <div class="image">
                        <div class="price-box">
                            <div class="inner-price">
                                {{-- <span class="price">
                                    <strong>30%</strong> <br> off per kg
                                </span> --}}
                            </div>
                        </div>
                        {{-- <img src="{{ asset('uploads') . '/' . $latest_product->image->filename }}" alt=""> --}}
                    </div>
                    <img src="{{ asset('uploads') . '/' . $latest_product->image->filename }}" alt="">
                </div>  
                <div class="content-column col-lg-6">
                    <h3><span class="orange-text">Newest</span>&nbsp;Arrival</h3>
                    <h4>{{ $latest_product->name }}</h4>
                    {{-- <div class="text">Quisquam minus maiores repudiandae nobis, minima saepe id, fugit ullam similique! Beatae, minima quisquam molestias facere ea. Perspiciatis unde omnis iste natus error sit voluptatem accusant</div> --}}
                    {{-- <div class="time-counter"><div class="time-countdown clearfix" data-countdown="2020/2/01"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div> --}}
                    <a data-quantity="{{ $latest_product->quantity }}" data-product-id="{{ $latest_product->id }}" data-target="" href="{{ $latest_product->quantity > 0 ? route('ajax.add', ['product_id' => $latest_product->id ]) : '#' }}" class="cart-btn"><i class="fas fa-shopping-cart"></i>{{ $latest_product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}</a>

                    {{-- <a data-product-id="{{ Auth::user() ? 2 : 0 }}" data-toggle="modal" data-target="#exampleModal" href="{{ Auth::user() ? route('ajax.add', ['product_id' => 2]) : route('login') }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
                </div>
            </div>
        </div>
    </section> -->
    <!-- end cart banner section -->

    <!-- advertisement section -->
    <div class="abt-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="abt-bg">
                        <a href="https://www.youtube.com/watch?v=laXCelcY5pI" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="abt-text">
                        <p class="top-sub">Since Year 1999</p>
                        <h2>We are <span class="orange-text">Fruitkha</span></h2>
                        <p>Etiam vulputate ut augue vel sodales. In sollicitudin neque et massa porttitor vestibulum ac vel nisi. Vestibulum placerat eget dolor sit amet posuere. In ut dolor aliquet, aliquet sapien sed, interdum velit. Nam eu molestie lorem.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente facilis illo repellat veritatis minus, et labore minima mollitia qui ducimus.</p>
                        <a href="{{ route('about') }}" class="boxed-btn mt-4">know more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end advertisement section -->

    <!-- shop banner -->
    <section class="shop-banner">
        <div class="container">
            <h3>December sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="{{ route('products') }}" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
    <!-- end shop banner -->

    <!-- latest news -->
    <div class="latest-news pt-150 pb-150">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">	
                        <h3><span class="orange-text">Our</span> Blog</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                    </div>
                </div>
            </div>

            <div class="row">


	        @foreach($blogs as $blog)
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="{{ route('blog', ['slug' => Str::slug($blog->title)]) }}"><div class=""><img src="{{ asset('uploads/' . $blog->image->filename) }}" /></div></a>
						<div class="news-text-box">
							<h3><a href="{{ route('blog', ['slug' => Str::slug($blog->title)]) }}">{{ $blog->title }}</a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i>{{ $blog->user->name }}</span>
								<span class="date"><i class="fas fa-calendar"></i>{{ Carbon\Carbon::parse($blog->date)->isoFormat('MMMM DD, YYYY') }}</span>
							</p>
							<p class="excerpt">{{ $blog->description }}</p>
							<a href="{{ route('blog', ['slug' => Str::slug($blog->title)]) }}" class="read-more-btn">Read More <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			@endforeach


{{-- 
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-news">
                        <a href="single-news.html"><div class="latest-news-bg news-bg-1"></div></a>
                        <div class="news-text-box">
                            <h3><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></h3>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Admin</span>
                                <span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
                            </p>
                            <p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
                            <a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-news">
                        <a href="single-news.html"><div class="latest-news-bg news-bg-2"></div></a>
                        <div class="news-text-box">
                            <h3><a href="single-news.html">A man's worth has its season, like tomato.</a></h3>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Admin</span>
                                <span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
                            </p>
                            <p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
                            <a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                    <div class="single-latest-news">
                        <a href="single-news.html"><div class="latest-news-bg news-bg-3"></div></a>
                        <div class="news-text-box">
                            <h3><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></h3>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Admin</span>
                                <span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
                            </p>
                            <p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
                            <a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div> --}}

            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('blogs') }}" class="boxed-btn">More Blogs</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end latest news -->

@endsection