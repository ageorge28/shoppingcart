@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Tax and Shipping</h3>
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
      
                        <div class="row">
                            <div class="col-2">
                                <b>Tax:</b>
                            </div>
                            <div class="col-10">
                                {{ $taxshipping->tax }} % <br />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-2">
                                <b>Shipping:</b>
                            </div>
                            <div class="col-10">
                                {{ $taxshipping->shipping }} <br />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-5">
                                <a class="btn btn-success" href="{{ route('admin.taxshipping.edit') }}">Edit</a>
                            </div>
                            {{-- <div class="col-10">
                                {{ $taxshipping->tax }} <br />
                            </div> --}}
                        </div>

                        {{-- <div class="table-responsive">
                            <table class="table table-striped  table-responsive">
                            <thead>
                                <tr>
                                <th>Tax</th>
                                <th>Shipping</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                    <tr>
                                        <td>{{ $taxshipping->tax }}</td>
                                        <td>{{ $taxshipping->shipping }}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('admin.taxshipping.edit') }}">Edit</a>
                                        </td>
                                    </tr>
                            </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
@endsection