@extends('admin.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Blog</h3>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('admin.blogs.update', ['blog' => $blog->id]) }}" method="post" enctype="multipart/form-data">
                            @method('PUT') 
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $blog->title }}">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug:</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $blog->slug }}">
                                @error('slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="ckeditor form-control" id="description" name="description" rows="4">{{ $blog->description }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Image upload</label>
                                <div>
                                    <img style="width:25%" src="{{ asset('uploads/'. $blog->image->filename) }}" />
                                </div>
                                 <input type="file" name="image" id="image" class="form-control file-upload-info" placeholder="Upload Image">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="blog_category">Blog Category</label>
                                <select class="form-control" id="blog_category" name="blog_category">
                                    @foreach($blog_categories as $blog_category)
                                        <option value="{{ $blog_category->id }}"
                                            @if ($blog_category->id == $blog->category_id)
                                                selected = "selected"
                                            @endif
                                        >
                                            {{ $blog_category->name }}
                                        </option>    
                                    @endforeach
                                </select>
                                @error('blog_category')
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

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

  @endsection