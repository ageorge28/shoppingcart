@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Blog Categories</h3>
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

                        <a href="{{ route('admin.blogcategories.create') }}" class="btn btn-rounded btn-info">Add Blog Category</a>
                        <div><br /></div>
        
                        <div class="table-responsive">
                            <table class="table table-striped  table-fit">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($blogcategories as $blogcategory)
                                    <tr>
                                        <td>{{ $blogcategory->id }}</td>
                                        <td>{{ $blogcategory->name }}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('admin.blogcategories.edit', ['blog_category' => $blogcategory->id]) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.blogcategories.delete', ['blog_category' => $blogcategory->id]) }}" method="post">                  
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