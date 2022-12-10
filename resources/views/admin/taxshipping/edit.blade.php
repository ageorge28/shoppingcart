@extends('admin.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Tax and Shipping</h3>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('admin.taxshipping.update') }}" method="post" enctype="multipart/form-data">
                            @method('PUT') 
                            @csrf
                            <div class="form-group">
                                <label for="tax">Tax:</label>
                                <input type="number" step=".01" min="0" class="form-control" id="tax" name="tax" placeholder="Tax" value="{{ $taxshipping->tax }}">
                                @error('tax')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="shipping">Shipping:</label>
                                <input type="number" step=".01" min="0" class="form-control" id="shipping" name="shipping" placeholder="Shipping" value="{{ $taxshipping->shipping }}">
                                @error('shipping')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>

  @endsection