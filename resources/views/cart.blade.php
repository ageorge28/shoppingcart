@extends('layouts.app')

@section('content')

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fresh and Organic</p>
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- cart -->
<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div id="message-alert"></div>
            </div>
        </div>
        
        <div class="row">
            <div><br /></div>
            <div class="col-lg-8 col-md-12">
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-remove"></th>
                                <th class="product-image">Product</th>
                                <th class="product-name">Name</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                            </tr>
                        </thead>
                        <tbody id="items">
                            @if ( ($cart) && count($cart->products) > 0)
                                @foreach($cart->products as $cart_product)
                                    <tr data-cart-product-id="{{ $cart_product->id }}" id="product-row-{{ $cart_product->id }}" class="table-body-row">
                                        <td class="product-remove"><a class="remove-product" data-cart-id="{{ $cart->id }}" data-cart-product-id="{{ $cart_product->id }}" data-target="#exampleModal" href="{{ route('ajax.delete', ['cart_product_id' => $cart_product->id]) }}"><i class="far fa-window-close"></i></a></td>
                                        <td class="product-image"><img src="uploads/{{ $cart_product->product->image->filename }}" alt=""></td>
                                        <td class="product-name">{{ $cart_product->product->name }}</td>
                                        <td class="product-price">₹{{ $cart_product->product->price }}</td>
                                        <td class="product-quantity"><input min="0" type="number" placeholder="0" value="{{ $cart_product->quantity }}"></td>
                                        <td class="product-total">₹{{ $cart_product->total }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No items added</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="total-section">
                    <table class="total-table">
                        <thead class="total-table-head">
                            <tr class="table-total-row">
                                <th>Total</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="total-data">
                                <td><strong>Subtotal: </strong></td>
                                <td data-subtotal="{{ !is_null($cart) ? $cart->subtotal : 0 }}" id="subtotal">₹{{ !is_null($cart) ? $cart->subtotal : 0 }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Discount: </strong></td>
                                <td data-discount="{{ is_null($cart) || $cart->coupon_id == 0 ? 0 : $cart->coupon->discount * $cart->subtotal / 100 }}" id="discount">₹{{ is_null($cart) || $cart->coupon_id == 0 ? 0 : $cart->coupon->discount * $cart->subtotal / 100 }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Shipping: </strong></td>
                                <td data-shipping="{{ !is_null($cart) ? $cart->shipping : 0 }}" id="shipping">₹{{ !is_null($cart) ? $cart->shipping : 0 }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Tax: </strong></td>
                                <td data-tax="{{ !is_null($cart) ? $cart->tax : 0 }}" id="tax">₹{{ !is_null($cart) ? $cart->tax : 0 }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Total: </strong></td>
                                <td data-total="{{ !is_null($cart) ? $cart->total : 0 }}" id="total">₹{{ !is_null($cart) ? $cart->total : 0}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if ($cart)
                        <div class="cart-buttons">
                            <span>
                                <form style="all:unset" method="POST" action="{{ route('ajax.update') }}">
                                    @csrf
                                    <button type="submit" id="update-cart" href="{{ route('ajax.update') }}" class="boxed-btn">Update Cart</button>
                                </form>
                                <a href="{{ route('checkout') }}" class="boxed-btn black">Check Out</a>
                            </span>
                        </div>
                    @endif
                </div>

                @if ($cart)
                    <div class="coupon-section">
                        <h3>Apply Coupon</h3>
                        <div class="coupon-form-wrap">
                            <form method="POST" action="/ajax/coupon">
                                @csrf
                                <p><input type="text" id="coupon_code" name="coupon_code" placeholder="Coupon" value="{{ !is_null($cart) && $cart->coupon_id != 0 ? $cart->coupon->code : '' }}"></p>
                                <p>
                                    <em class="{{ is_null($cart) || $cart->coupon_id == 0 ? 'text-danger' : 'text-success' }}" id="coupon-alert">{{ is_null($cart) || $cart->coupon_id == 0 ? '' : 'Coupon Applied' }}</em>
                                </p>
                                <p><input type="submit" id="coupon_btn" value="{{ is_null($cart) || $cart->coupon_id == 0 ? 'Apply' : 'Remove Coupon' }}"></p>
                            </form>
                        </div>
                    </div>
                @endif  
            </div>
        </div>
    </div>
</div>
<!-- end cart -->

@endsection