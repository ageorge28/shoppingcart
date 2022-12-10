@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Statuses</h3>
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

                        <a href="{{ route('admin.statuses.create') }}" class="btn btn-rounded btn-info">Add Status</a>
                        <div><br /></div>
        
                        <div class="table-responsive">
                            <table class="table table-striped  table-responsive">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th style="margin:0; padding:2px" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($statuses as $status)
                                    <tr>
                                        <td>{{ $status->id }}</td>
                                        <td>{{ $status->status }}</td>
                                        <td style="margin:0; padding:2px">
                                            <a class="btn btn-success" href="{{ route('admin.statuses.edit', ['status' => $status->id ]) }}">Edit</a>
                                        </td>
                                        <td style="margin:0; padding:2px">
                                            <form action="{{ route('admin.statuses.delete', ['status' => $status->id ]) }}" method="post">                  
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