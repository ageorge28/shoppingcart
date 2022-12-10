@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Companies</h3>
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

                        <a href="{{ route('admin.companies.create') }}" class="btn btn-rounded btn-info">Add Company</a>
                        <div><br /></div>
        
                        <div class="table-responsive">
                            <table class="table table-striped  table-responsive">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($companies as $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td class="py-1">
                                            <img src="{{ asset('/uploads/' . $company->image->filename) }}"
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('admin.companies.edit', ['company' => $company->id ]) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.companies.delete', ['company' => $company->id ]) }}" method="post">                  
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