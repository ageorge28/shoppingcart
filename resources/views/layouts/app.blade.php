<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">
	<meta name="token" content="{{ csrf_token() }}">
	<!-- title -->
	<title>Fruitkha - {{ $title }}</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('/img/favicon.png') }}">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
	<!-- bootstrap -->
	{{-- <link rel="stylesheet" href="bootstrapcss/bootstrap.min.css"> --}}
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{ asset('/css/owl.carousel.css') }}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{ asset('/css/meanmenu.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ asset('/css/main.css') }}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('/css/responsive.css') }}">

</head>
<body>
	
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="{{ route('home') }}">
								<img src="{{ asset('img/logo.png') }}" alt="">
							</a>
						</div>
						<!-- logo -->

						@php
							$home = false;
							$about = false;
							$shop = false;
							$blog = false;
							$contact = false;
							
							$url = request()->path();

							$about = Str::contains($url, 'about');
							$contact = Str::contains($url, 'contact');
							$blog = Str::contains($url, 'blog');
							$shop = Str::contains($url, 'products') || Str::contains($url, 'cart') || Str::contains($url, 'checkout') || Str::contains($url, 'order') || Str::contains($url, 'payment');
							$home = !($about || $contact || $blog || $shop);
						@endphp

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="{{ $home ? 'current-list-item' : '' }}"><a href="{{ route('home') }}">Home</a></li>
								<li class="{{ $about ? 'current-list-item' : '' }}"><a href="{{ route('about') }}">About</a></li>
								<li class="{{ $shop ? 'current-list-item' : '' }}"><a href="{{ route('products') }}">Shop</a>
 								<li class="{{ $blog ? 'current-list-item' : '' }}"><a href="{{ route('blogs') }}">Blog</a></li>
								<li class="{{ $contact ? 'current-list-item' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i><span class="cart-count {{ is_null($cart) || $cart->items() == 0 ? ' d-none' : '' }}">{{ !is_null($cart) ? $cart->items() : 0 }}</span></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                                        @if(Auth::user() && Auth::user()->is_admin == 0)
											<a class="shopping-cart" href="{{ route('dashboard') }}">My Account</a>
											<ul class="sub-menu">
												<li><a href="{{ route('dashboard') }}">My Profile</a></li>
												<li><a href="{{ route('orders') }}">My Orders</a></li>
												<li><a href="{{ route('address') }}">My Addresses</a></li>
												<li>
													<a>
														<form method="POST" action="{{ route('logout') }}">
															@csrf
															<button style="all:unset" type="submit" class="btn btn-link" value="Log Out">Logout</button>
														</form>
													</a>
												</li>
											</ul>
		
                                        @else
                                            <a class="shopping-cart" href="{{ route('login') }}">Login</a>
                                            <a class="shopping-cart" href="{{ route('register') }}">Register</i></a>
                                        @endif
                                    
                                    </div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
	
	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<form method="get" action="{{ route('search') }}">
								@csrf
								<input id="keywords" name="keywords" type="text" placeholder="Keywords">
								<button type="submit">Search <i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->

    @yield('content')

	 <!-- logo carousel -->
	 <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        @foreach ($companies as $company)
							<div class="single-logo-item">
								<img src="{{ asset('uploads') . '/' . $company->image->filename }}" alt="">
							</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->

    <!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>34/8, East Hukupara, Gifirtok, Sadan.</li>
							<li>support@fruitkha.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="{{ route('home') }}">Home</a></li>
							<li><a href="{{ route('about') }}">About</a></li>
							<li><a href="{{ route('products') }}">Shop</a></li>
							<li><a href="{{ route('blogs') }}">Blog</a></li>
							<li><a href="{{ route('contact') }}">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->
	
	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2019 - All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Item Added</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="modal-body" class="modal-body">
              <p></p>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}
          </div>
        </div>
      </div>
	
	<!-- jquery -->
	{{-- <script src="{{ asset('/js/jquery-3.6.0.min.js') }}"></script> --}}
	
	<script src="{{ asset('/js/jquery-1.11.3.min.js') }}"></script>

	<script src="{{ asset('/js/jquery-ui.js') }}"></script>
	<!-- bootstrap -->
	{{-- <script src="/bootstrapjs/bootstrap.min.js"></script> --}} 
	<!-- count down -->
	<script src="{{ asset('/js/jquery.countdown.js') }}"></script>
	<!-- isotope -->
	<script src="{{ asset('/js/jquery.isotope-3.0.6.min.js') }}"></script>
	<!-- waypoints -->
	<script src="{{ asset('/js/waypoints.js') }}"></script>
	<!-- owl carousel -->
	<script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
	<!-- magnific popup -->
	<script src="{{ asset('/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- mean menu -->
	<script src="{{ asset('/js/jquery.meanmenu.min.js') }}"></script>
	<!-- sticker js -->
	<script src="{{ asset('/js/sticker.js') }}"></script>
	<!-- main js -->
	<!-- bootstrap -->
	{{-- <script src="{{ asset('/js/bootstrap.min.js') }}"></script> --}}
	{{-- <script src="/bootstrapjs/bootstrap.js"></script> --}}

	<!-- JavaScript Bundle with Popper -->
	<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('/js/main.js') }}"></script>
	{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}

</body>
</html>