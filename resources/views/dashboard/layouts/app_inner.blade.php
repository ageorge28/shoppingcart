@extends('layouts.app_inner')

@section('content')

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg" style="padding: 50px 0 !important">
		<div class="container">
			<div class="row">
				{{-- <div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>We sale fresh fruits</p>
						<h1>Dashboard</h1>
					</div>
				</div> --}}
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- team section -->
	<div class="mt-100 mb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					{{-- @if(session()->get('error'))
						<div class="alert alert-danger">
							{{ session()->get('error') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div><br /></div>
					@endif 	 --}}
					<div class="section-title">
						<h3>Dashboard</span></h3>
					</div>
				</div>

				<div class="col-lg-12">
					<div>
						@if ($message = session()->get('success'))
							<div class="alert alert-success">{{ $message }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
							</div>
						@endif
					</div>
				</div>


				<div class="col-lg-12">
					<div class="row">
                        @yield('dashboard')
					  </div>



				</div>
			</div>


		</div>
	</div>
	<!-- end team section -->

@endsection