@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Products</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div><br /></div>
                         @endif 
                             
                            <a href="{{ route('admin.products.create') }}" class="btn btn-rounded btn-info">Add Product</a>
                            <div><br /></div>
                                               
                        <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($products as $product)
                                
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-wrap">{{ $product->description }}</td>
                                        <td>
                                            <img src="{{ asset('/uploads/'. $product->image->filename) }}" />
                                        </td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>₹{{ $product->price }}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('admin.products.edit', ['product' => $product->id]) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.products.delete', ['product' => $product->id]) }}" method="post">                  
                                                @csrf                  
                                                @method('DELETE')                  
                                                <button class="btn btn-danger" type="submit">Delete</button>                
                                            </form>
                                        </td>
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