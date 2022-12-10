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
                            
                            @if(session()->get('success'))
                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                            <div><br /></div>
                            @endif 
                                                                       
                        <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th class="text-wrap">Order Number</th>
                                <th>User</th>
                                <th>Cart ID</th>
                                <th>Shipping Address</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Flag</th>
                                <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($orders as $order)
                                
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td class="text-wrap">{{ is_null($order->user) ? 'Guest' : $order->user->name }}</td>
                                        <td>{{ $order->cart_id }}</td>
                                        <td class="text-wrap">{{ is_null($order->shipping_address) ? 'None' : $order->shipping_address->address1 }} <br/> {{ is_null($order->shipping_address) ? 'None' : $order->shipping_address->address2 }}</td> 
                                        <td>₹{{ is_null($order->cart) ? 0 : $order->cart->total }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td>{{ $order->status->status }}</td>
                                        <td>{{ $order->flag ? 'Paid' : 'Unpaid' }}</td>
                                        <td style="padding:2px; margin:0">
                                            <a class="btn btn-info" href="{{ route('admin.orders.show', ['order' => $order->id]) }}">View</a>
                                        </td>
                                        <td style="padding:2px; margin:0">
                                            <a class="btn btn-success" href="{{ route('admin.orders.edit', ['order' => $order->id]) }}">Edit</a>
                                        </td>
                                        {{-- <td style="padding:2px; margin:0">
                                            <form action="/admin/orders/{{ $order->id}}/delete" method="post">                  
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