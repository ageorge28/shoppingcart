@extends('dashboard.layouts.app')

@section('dashboard')

<div class="col-lg-2 mb-5">
    @include('dashboard.layouts.navigation')
</div>
<div class="col-lg-10">

        <div class="accordion" id="accordionExample">
            @foreach($orders as $order)

                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading{{ $order->order_number }}">

                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->order_number }}" aria-expanded="true" aria-controls="collapse{{ $order->order_number }}">
                        <span style="color: #F28123" class="fa {{ $order->flag ? 'fa-check-circle' : 'fa-times-circle' }}">&nbsp;&nbsp;</span><span style="color: #F28123"">
                            Order Number #{{ $order->order_number . ' - ' . Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->date)->format('M d, Y H:i') }} - Payment {{ $order->flag ? 'Success' : 'Failed' }}
                        </span>
                        &nbsp;
                       
                    </button>                          
                                
                </h2>

                </div>

                <div id="collapse{{ $order->order_number }}" class="accordion-collapse collapse mb-5" aria-labelledby="headingOne" data-bs-parent="#accordionExample" data-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row" style="width:15%">
                            <span>
                                @if($order->flag == false)
                                {{ session()->put('id', $order->id) }}
                                <a href="{{ route('order', ['order_id' => $order->id]) }}" class="boxed-btn" style="width: 120px;margin: 0;padding: 0;border-radius: 10px;text-align: center; display:inline-table">Retry Payment</a>
                            @endif
                            </span>
                        </div>
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
                                                <td class="product-price">${{ $cart_product->product->price }}</td>
                                                <td class="product-quantity">{{ $cart_product->quantity }}</td>
                                                <td class="product-total">${{ $cart_product->total }}</td>
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
                                            <td><strong>Total: </strong></td>
                                            <td data-total="{{ $order->cart->subtotal }}" id="total">₹{{ $order->cart->total }}</td>
                                        </tr>
                                    </tbody>
                            </table>
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
                            
                            <br />

                        </div>
                    </div>
            @endforeach
        </div>


</div>

@endsection