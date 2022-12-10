@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Carts</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            
                            @if(session()->get('success'))
                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                            <div><br /></div>
                            @endif 
                                                                          
                        <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Cart ID</th>
                                    <th>User</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Discount</th>
                                    <th>Shipping</th>
                                    <th>Tax</th>                                    
                                    <th>Total</th>
                                    <th>Date</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Flag</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($carts as $cart)
                                
                                    <tr>
                                        <td>{{ $cart->id }}</td>
                                        <td>{{ is_null($cart->user) ? 'Guest' : $cart->user->name }}</td>
                                        <td class="text-wrap">{{ $cart->quantity }}</td>
                                        <td class="text-wrap">₹{{ $cart->subtotal }}</td>
                                        <td class="text-wrap">₹{{ !is_null($cart->coupon) ? $cart->subtotal * $cart->coupon->discount / 100 : 0 }}</td>
                                        <td class="text-wrap">₹{{ $cart->shipping }}</td>
                                        <td class="text-wrap">₹{{ is_null($cart->tax) ? '0.00' : $cart->tax }}</td>
                                        <td class="text-wrap">₹{{ $cart->total }}</td>
                                        <td class="text-wrap">{{ $cart->date }}</td>
                                        {{-- <td class="text-wrap">{{ $cart->status->status }}</td> --}}
                                        <td class="text-wrap">{{ $cart->flag ? 'Done' : 'Pending' }}</td>
                                        <td style="margin:0; padding:2px">
                                            <a class="btn btn-primary" href="{{ route('admin.carts.show', ['cart' => $cart->id]) }}">View</a>
                                        </td>                                        
                                        {{-- <td style="margin:0; padding:2px">
                                            <a class="btn btn-success" href="{{ route('admin.carts.edit', ['cart' => $cart->id]) }}">Edit</a>
                                        </td> --}}
                                        {{-- <td style="margin:0; padding:2px">
                                            <form action="/admin/carts/{{ $cart->id}}/delete" method="post">                  
                                                @csrf                  
                                                @method('DELETE')                  
                                                <button class="btn btn-danger" type="submit">Delete</button>                
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                             </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
@endsection