<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Fruitkha Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/jquery-bar-rating/css-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    {{-- <link rel="stylesheet" href="/css/main.css"> --}}
    
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('/img/favicon.png') }}" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <img src="{{ asset('/images/administrator.jfif') }}" alt="profile" />
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center">Administrator</span>
                {{-- <span class="text-secondary icon-sm text-center">₹3499.00</span> --}}
              </div>
            </a>
          </li>
          <li class="nav-item pt-3">
            <a class="nav-link d-block" href="{{ route('admin') }}">
              <img class="sidebar-brand-logo" src="/images/logo.svg" alt="" />
              <img class="sidebar-brand-logomini" src="/images/logo-mini.svg" alt="" />
              {{-- <div class="small font-weight-light pt-1">Responsive Dashboard</div> --}}
            </a>
         </li>

        @php
            $url = request()->path();
            $categories = Str::contains($url, 'categories');
            $products = Str::contains($url, 'products');
            $carts = Str::contains($url, 'carts');
            $orders = Str::contains($url, 'orders');
            $taxshipping = Str::contains($url, 'taxshipping');
            $coupons = Str::contains($url, 'coupons');
            $blogs = Str::contains($url, 'blogs');
            $blogcategory = Str::contains($url, 'blogcategory');
            $companies = Str::contains($url, 'companies');
            $statuses = Str::contains($url, 'statuses');           
        @endphp


          <li class="pt-2 pb-1">
            <span class="nav-item-head">MENU</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin') }}">
              <i class="mdi mdi-compass-outline"></i>
              &ensp;
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{ $categories ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.categories') }}">
              <i class="mdi mdi-folder"></i>
              &ensp;
              <span class="menu-title">Categories</span>
            </a>
          </li>
          <li class="nav-item {{ $products ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.products') }}">
              <i class="mdi mdi-food-apple"></i>
              &ensp;
              <span class="menu-title">Products</span>
            </a>
          </li>
          <li class="nav-item {{ $carts ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.carts') }}">
              <i class="mdi mdi-cart"></i>
              &ensp;
              <span class="menu-title">Carts</span>
            </a>
          </li>
          <li class="nav-item {{ $orders ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.orders') }}">
              <i class="mdi mdi-currency-usd"></i>
              &ensp;
              <span class="menu-title">Orders</span>
            </a>
          </li>
          <li class="nav-item {{ $taxshipping ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.taxshipping') }}">
              <i class="mdi mdi-truck"></i>
              &ensp;
              <span class="menu-title">Tax & Shipping</span>
            </a>
          </li>

          <li class="nav-item {{ $coupons ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.coupons') }}">
              <i class="mdi mdi-tag-multiple"></i>
              &ensp;
              <span class="menu-title">Coupons</span>
            </a>
          </li>
          <li class="nav-item {{ $blogs ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.blogs') }}">
              <i class="mdi mdi-comment"></i>
              &ensp;
              <span class="menu-title">Blogs</span>
            </a>
          </li>
          <li class="nav-item {{ $blogcategory ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.blogcategories') }}">
              <i class="mdi mdi-blogger"></i>
              &ensp;
              <span class="menu-title">Blog Categories</span>
            </a>
          </li>

          <li class="nav-item {{ $companies ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.companies') }}">
              <i class="mdi mdi-domain"></i>
              &ensp;
              <span class="menu-title">Companies</span>
            </a>
          </li>
          <li class="nav-item {{ $statuses ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.statuses') }}">
              <i class="mdi mdi-clipboard-flow"></i>
              &ensp;
              <span class="menu-title">Statuses</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        {{-- <div id="settings-trigger"><i class="mdi mdi-settings"></i></div> --}}
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles default primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles light"></div>
          </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo-mini" href="/admin"><img src="/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-logout d-none d-lg-block">
                @if(Auth::user())
                  <a class="shopping-cart">
                    <form method="POST" action="{{ route('admin.logout') }}">
                      @csrf
                      <button style="all:unset" type="submit" class="btn btn-link text-light" value="Log Out">Logout</button>
                    </form>
                  </a>
                @endif
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>

        @yield('content')

        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Fruitkha 2020</span>
              {{-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span> --}}
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('/vendors/flot/jquery.flot.stack.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('/js/misc.js') }}"></script>
    <script src="{{ asset('/js/settings.js') }}"></script>
    <script src="{{ asset('/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    {{-- <script src="{{ asset('/js/dashboard.js') }}"></script> --}}
    
    <!-- End custom js for this page -->
  </body>
</html>