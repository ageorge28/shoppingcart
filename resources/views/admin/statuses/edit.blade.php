@extends('admin.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Status</h3>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('admin.statuses.update', ['status' => $status->id ]) }}" method="post" enctype="multipart/form-data">
                            @method('PUT') 
                            @csrf
                            <div class="form-group">
                                <label for="name">Status</label>
                                <input type="text" class="form-control" id="status" name="status" placeholder="Status" value="{{ $status->status }}">
                                @error('status')
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