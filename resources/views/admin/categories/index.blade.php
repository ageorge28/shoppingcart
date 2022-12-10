@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Categories</h3>
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

                        <a href="{{ route('admin.categories.create') }}" class="btn btn-rounded btn-info">Add Category</a>
                        <div><br /></div>
        
                        <div class="table-responsive">
                            <table class="table table-striped  table-fit">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-wrap">{{ $category->description }}</td>
                                        <td class="py-1">
                                            <img src="{{ asset('/uploads/' . $category->image->filename) }}"
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.categories.delete', ['category' => $category->id]) }}" method="post">                  
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