@extends('admin.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Orders</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-2">
                                <b>Paid:</b>
                            </div>
                            <div class="col-10">
                                {{ $order->flag ? 'Yes' : 'No' }}	
                            </div>
                        </div>

                        <br />

                        <div class="row">
                            <div class="col-2">
                                <b>Status:</b>
                            </div>
                            <div class="col-10">
                                {{ $order->status->status }}	
                            </div>
                        </div>

                   
                        <br />
                    
                        <br />

<h6>Items</h6>
<div class="cart-table-wrap">
    <table class="cart-table">
        <thead class="cart-table-head">
                <tr class="table-head-row">
                    <th class="product-image">Product</th>
                    <th class="product-name">Name</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                </tr>
        </thead>
        <tbody>
                @foreach($order->cart->products as $cart_product)
                    <tr class="table-body-row">
                        <td class="product-image"><img src="{{ asset('uploads/' . $cart_product->product->image->filename) }}" alt=""></td>
                        <td class="product-name">{{ $cart_product->product->name }}</td>
                        <td class="product-price">₹{{ $cart_product->product->price }}</td>
                        <td class="product-quantity">{{ $cart_product->quantity }}</td>
                        <td class="product-total">₹{{ $cart_product->total }}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>

<br />

<div class="total-section">
   <table class="total-table">
            <thead class="total-table-head">
                <tr class="table-total-row">
                    <th>Totals</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr class="total-data">
                    <td><strong>Subtotal: </strong></td>
                    <td data-subtotal="{{ $order->cart->subtotal }}" id="subtotal">₹{{ $order->cart->subtotal }}</td>
                </tr>
                <tr class="total-data">
                    <td><strong>Discount: </strong></td>
                    <td id="discount">₹{{ !is_null($order->cart->coupon) ? $order->cart->subtotal * $order->cart->coupon->discount / 100 : 0 }}</td>
                </tr>
                <tr class="total-data">
                    <td><strong>Shipping: </strong></td>
                    <td data-shipping="{{ $order->cart->shipping }}" id="shipping">₹{{ $order->cart->shipping }}</td>
                </tr>
                <tr class="total-data">
                    <td><strong>Tax: </strong></td>
                    <td id="tax">₹{{ is_null($order->cart->tax) ? '0.00' : $order->cart->tax }}</td>
                </tr>
                <tr class="total-data">
                    <td><strong>Total: </strong></td>
                    <td data-total="{{ $order->cart->subtotal }}" id="total">₹{{ $order->cart->total }}</td>
                </tr>
            </tbody>
    </table>
</div>

<br /><br />

    <div class="row">
        <div class="col-2">
            <b>Shipping Address:</b>
        </div>
        <div class="col-10">
            {{ $order->shipping_address->name }} <br />
            {{ $order->shipping_address->address1 }} <br />
            {{ $order->shipping_address->address2 }} <br />
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>
@endsection