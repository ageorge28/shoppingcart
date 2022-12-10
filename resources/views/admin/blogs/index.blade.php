@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Blogs</h3>
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

                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-rounded btn-info">Add Blog</a>
                        <div><br /></div>
        
                        <div class="table-responsive">
                            <table class="table table-striped  table-fit">
                            <thead>
                                <tr>
                                <th>ID</th>
                                {{-- <th>User</th> --}}
                                <th>Title</th>
                                <th>Slug</th>
                                {{-- <th>Description</th> --}}
                                <th>Date</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        {{-- <td>{{ $blog->user->name }}</td> --}}
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->slug }}</td>
                                        {{-- <td class="text-wrap">{{ $blog->description }}</td> --}}
                                        <td>{{ $blog->date }}</td>
                                        <td>{{ $blog->category->name }}</td>
                                        <td class="py-1">
                                            <img src="{{ asset('/uploads/' . $blog->image->filename) }}"
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('admin.blogs.edit', ['blog' => $blog->id]) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.blogs.delete', ['blog' => $blog->id]) }}" method="post">                  
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