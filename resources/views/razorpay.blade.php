@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Orders</h2>
        </div>
        <div class="pull-right">
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
    "amount": "500", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Fruitkha",
    "description": "Test Transaction",
    "image": "https://technext.github.io/frutika/assets/img/logo.png",
    "order_id": "{{ $order_id }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "http://127.0.0.1:8000/checkout-callback",
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
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>

@endsection