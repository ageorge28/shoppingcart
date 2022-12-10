@extends('admin.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">View Cart</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-5">
                            <div class="col-2"><strong>Cart ID :</strong></div>
                            <div class="col-10">{{ $cart->id }}</div>
                        </div>                        
                        <div class="row pb-5">
                            <div class="col-2"><strong>User :</strong></div>
                            <div class="col-10">{{ is_null($cart->user) ? 'Guest' : $cart->user->name }}</div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-2"><strong>Date :</strong></div>
                            <div class="col-10">{{ $cart->date }}</div>
                        </div>
                        {{-- <div class="row pb-5">
                            <div class="col">Status :</div>
                            <div class="col">{{ $cart->status->status }}</div>
                        </div> --}}
                        <div class="row pb-5">
                            <div class="col-2"><strong>Status :</strong></div>
                            <div class="col-10">{{ $cart->flag ? 'Done' : 'Pending' }}</div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-12">
                                <h6>Shopping Cart Contents</h6>
                                <br />
                                <div class="cart-table-wrap">
                                    <table class="cart-table">
                                        <thead class="cart-table-head">
                                        <tr class="table-head-row">
                                            <th class="product-image">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-total">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart_products as $cart_product)
                                            <tr>
                                                <td class="product-image">
                                                    <img src="{{ asset('uploads/' . $cart_product->product->image->filename) }}" />
                                                    {{ $cart_product->product->name }}
                                                </td>
                                                <td class="product-price">₹{{ $cart_product->product->price }}</td>
                                                <td class="product-quantity">{{ $cart_product->quantity }} </td>
                                                <td class="product-total">₹{{ $cart_product->total }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                            

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
                                             <td data-subtotal="{{ $cart->subtotal }}" id="subtotal">₹{{ $cart->subtotal }}</td>
                                         </tr>
                                         <tr class="total-data">
                                             <td><strong>Discount: </strong></td>
                                             <td id="discount">₹{{ !is_null($cart->coupon) ? $cart->subtotal * $cart->coupon->discount / 100 : 0 }}</td>
                                         </tr>
                                         <tr class="total-data">
                                            <td><strong>Shipping: </strong></td>
                                            <td data-shipping="{{ $cart->shipping }}" id="shipping">₹{{ $cart->shipping }}</td>
                                        </tr>
                                        <tr class="total-data">
                                            <td><strong>Tax: </strong></td>
                                            <td data-tax="{{ $cart->tax }}" id="tax">₹{{ is_null($cart->tax) ? '0.00' : $cart->tax }}</td>
                                        </tr>
                                       <tr class="total-data">
                                             <td><strong>Total: </strong></td>
                                             <td data-total="{{ $cart->subtotal }}" id="total">₹{{ $cart->total }}</td>
                                         </tr>
                                     </tbody>
                             </table>
                         </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

  @endsection