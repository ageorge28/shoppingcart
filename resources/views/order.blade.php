@extends('layouts.app')

@section('content')

    <!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Payments</h1>
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

				<form action="{{ route('payment') }}" method="POST" >                        
					<script src="https://checkout.razorpay.com/v1/checkout.js"
							data-key="rzp_test_TLlTnyFjmNuRLo"
							data-amount="{{ $order->cart->total * 100 }}"
							data-buttontext="Pay INR ₹	{{ $order->cart->total }}"
							data-name="Fruitika"
							data-description="Razorpay Payment"
							data-image="https://technext.github.io/frutika/assets/img/logo.png"
							data-prefill.name="Name"
							data-prefill.email="E-mail"
							data-theme.color="#F28123">
					</script>
					<input type="hidden" name="_token" value="{!!csrf_token()!!}">
				</form>

				{{-- <div class="col-sm-3">
                    <h4>Total Amount: <em>${{ $order->cart->total }}</em></h4>
				</div>
				<div class="col-sm-2">
					<button class="boxed-btn" id="pay-button">Click to Pay</button>
				</div> --}}
			</div>
		</div>
	</div>
	<!-- end check out section -->

	{{-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script>
	var options = {
		"key": "rzp_test_TLlTnyFjmNuRLo", // Enter the Key ID generated from the Dashboard
		"amount": "{{ $order->cart->total * 100 }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
		"currency": "INR",
		"name": "Fruitkha",
		"description": "Test Transaction",
		"image": "https://technext.github.io/frutika/assets/img/logo.png",
		// "order_id": "{{ session('order_id') }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
		// "callback_url": "http://127.0.0.1:8000/process",
		// "handler": function (response){
		// 	alert(JSON.stringify(response));
		// 	alert(response.razorpay_payment_id);
		// 	alert(response.razorpay_order_id);
		// 	alert(response.razorpay_signature)
		// },		
		"prefill": {
			"name": "John Doe",
			"email": "john.doe@example.com",
			"contact": "9999999999"
		},
		"notes": {
			"address": "Razorpay Corporate Office"
		},
		"theme": {
			"color": "#3399cc"
		}
	};
	var rzp1 = new Razorpay(options);
	var result = '{{ session('order_id') }}' ;
	document.getElementById('pay-button').onclick = function(e){
		if (result == '')
		{
			alert('Razorpay API Not working');
		}
		else
		{
			rzp1.open();
		}
		e.preventDefault();
	}
	</script> --}}

@endsection