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

                        <div class="row">
                            <div class="col-2">
                                <b>Status:</b>
                            </div>
                            <div class="col-10">
                                <form action="{{ route('admin.orders.update', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <select name="status" id="status">
                                    <option value="0">-- Select Order Status --</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" {{ $status->id == $order->status->id ? 'selected' : '' }}>{{ $status->status }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" value="Update" id="submit" name="submit" />
                            </div>
                        </div>


</div>
</div>
</div>
</div>
</div>
@endsection