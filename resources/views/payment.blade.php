@extends('layouts.app')

@section('content')

    <!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Order Status</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-sm-1" style="padding-top:13px">
					<span style="color: #F28123; font-size:2rem;" class="{{ $status == 'success' ? 'fa fa-check-circle' : 'fa fa-times-circle' }}"></	span>
				</div>
				<div class=col-sm-11>
					<span style='font-size:2rem; font-family:"Open Sans", sans-serif'>Your Order has {{ $status == 'success' ? 'been successfully placed. You can view details of your order in My Orders section in your Dashboard' : 'failed. Retry payment in My Orders section in your Dashboard' }}</span>			
				</div>
			</div>
		</div>
	</div>
	<!-- end check out section -->

@endsection