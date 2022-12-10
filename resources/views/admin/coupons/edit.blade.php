@extends('admin.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Coupon</h3>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('admin.coupons.update', ['coupon' => $coupon->id ]) }}" method="post">
                            @method('PUT') 
                            @csrf
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="Code" value="{{ $coupon->code }}">
                                @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount %</label>
                                <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount" value="{{ $coupon->discount }}">
                                @error('discount')
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